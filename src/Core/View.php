<?php

namespace App\Core;

class View
{
    /**
     * Caminho referente aos arquivos do diretorio da views
     * @var string
     */
    protected string $filesPath;

    /**
     * Caminhos da views, com valor default em src/Views/
     * @param string $viewsPath
     */
    public function __construct(string $viewsPath = __DIR__ . '/../Views/')
    {
        $this->filesPath = rtrim($viewsPath, '/');
    }

    /**
     * Renderiza uma view com layout e parâmetros.
     * @param string $view Nome da view (ex: 'home')
     * @param string $layout Nome do layout (ex: 'main')
     * @param array $params Parâmetros para substituição
     * @return string Conteúdo renderizado
     */
    public function render(string $view, string $layout = 'layout', array $params = []): void
    {
        $viewContent = $this->fetchFile($this->filesPath . "/$view.php");


        $layoutContent = $this->fetchFile($this->filesPath . "/layout/$layout.php");


        // Caso Layout tenha sido definido, coloca o conteúdo da view dentro do layout
        $fullContent = str_replace('{{content}}', $viewContent, $layoutContent);

        // Substitui parâmetros
        echo $this->renderParams($fullContent, $params);
    }

    /**
     * Substitui placeholders por valores.
     * Suporta {{param}} (escapado) e {{raw:param}} (HTML puro)
     */
    protected function renderParams(string $content, array $params): string
    {
        foreach ($params as $key => $value) {
            $escaped = htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $content = str_replace('{{' . $key . '}}', $escaped, $content);
            $content = str_replace('{{raw:' . $key . '}}', (string)$value, $content);
        }
        return $content;
    }

    /**
     * Carrega o conteúdo de um arquivo PHP e retorna como string
     * @throws \RuntimeException se o arquivo não existir
     */
    protected function fetchFile(string $path): string
    {
        if (!file_exists($path)) {
            throw new \RuntimeException("Arquivo não encontrado: $path");
        }

        ob_start();
        include $path;
        return ob_get_clean();
    }
}