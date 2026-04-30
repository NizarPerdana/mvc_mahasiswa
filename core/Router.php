<?php
// core/Router.php
// Kelas Router — memecah URL dan memanggil controller/method yang sesuai

class Router
{
    private string $controller = 'HomeController';
    private string $method     = 'index';
    private array  $params     = [];

    /**
     * Memecah URL dari parameter GET menjadi:
     * [0] controller, [1] method, [2..n] params
     */
    public function parseURL(): array
    {
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        return $url ? explode('/', filter_var($url, FILTER_SANITIZE_URL)) : [];
    }

    /**
     * Menentukan controller, method, dan params lalu menjalankannya.
     */
    public function run(): void
    {
        $urlParts = $this->parseURL();

        // Tentukan controller
        if (!empty($urlParts[0])) {
            $controllerName = ucfirst(strtolower($urlParts[0])) . 'Controller';
            $controllerFile = CONTROLLERPATH . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($urlParts[0]);
            } else {
                $this->notFound("Controller <strong>{$controllerName}</strong> tidak ditemukan.");
                return;
            }
        }

        // Load file controller
        require_once COREPATH . 'Controller.php';
        require_once CONTROLLERPATH . $this->controller . '.php';
        $controllerObj = new $this->controller();

        // Tentukan method
        if (!empty($urlParts[1])) {
            if (method_exists($controllerObj, $urlParts[1])) {
                $this->method = $urlParts[1];
                unset($urlParts[1]);
            } else {
                $this->notFound("Method <strong>{$urlParts[1]}</strong> tidak ditemukan di controller <strong>{$this->controller}</strong>.");
                return;
            }
        }

        // Sisanya adalah params
        $this->params = array_values($urlParts);

        // Panggil method dengan params
        call_user_func_array([$controllerObj, $this->method], $this->params);
    }

    /**
     * Tampilkan halaman 404 sederhana.
     */
    private function notFound(string $message): void
    {
        http_response_code(404);
        echo "<h1>404 - Halaman Tidak Ditemukan</h1><p>{$message}</p>";
        echo "<a href='" . BASEURL . "'>← Kembali ke Home</a>";
    }
}