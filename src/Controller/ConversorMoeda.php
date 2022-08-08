<?php
namespace App\Controller;

use App\RenderHtml;
use App\ProcessaRequisicao;

class ConversorMoeda implements ProcessaRequisicao 
{
    public function Processa() {
      // Renderiza formulário do Conversos de Moedas
      echo RenderHtml::Render('Conversor.php');
      exit;
    }
}