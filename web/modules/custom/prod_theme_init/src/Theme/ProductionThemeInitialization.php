<?php

namespace Drupal\prod_theme_init\Theme;

use Drupal\Core\Theme\ThemeInitializationInterface;
use Drupal\Core\Theme\ActiveTheme;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\Extension;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Substitui o ThemeInitialization padrão para só usar cache.
 */
class ProductionThemeInitialization implements ThemeInitializationInterface
{

  protected $root;
  protected $themeHandler;
  protected $cache;
  protected $moduleHandler;

  public function __construct($root, ThemeHandlerInterface $theme_handler, CacheBackendInterface $cache, ModuleHandlerInterface $module_handler)
  {
    $this->root = $root;
    $this->themeHandler = $theme_handler;
    $this->cache = $cache;
    $this->moduleHandler = $module_handler;
  }

  public function initTheme($theme_name)
  {
    return $this->getActiveThemeByName($theme_name);
  }

  public function getActiveThemeByName($theme_name)
  {
    // Só lê do cache, nunca faz o scan.
    if ($cached = $this->cache->get('theme.active_theme.' . $theme_name)) {
      return $cached->data;
    }
    // Se não tiver cache, aborta pra você pré-aquecer via Drush.
    throw new \RuntimeException("Theme registry cache para '{$theme_name}' não encontrado. Rode 'drush php:eval \"\\Drupal::service('theme.initialization')->getActiveThemeByName('$theme_name');\"' no CLI.");
  }

  public function loadActiveTheme(ActiveTheme $active_theme)
  {
    // Não faz nada: o core já irá carregar o Twig engine e as libs em cache.
  }

  public function getActiveTheme(Extension $theme, array $base_themes = [])
  {
    // Não usado nesta versão “só cache”.
    throw new \BadMethodCallException('Não deveria chegar aqui.');
  }
}