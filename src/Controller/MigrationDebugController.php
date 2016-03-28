<?php

/**
 * @file
 * Contains \Drupal\d8_migrate_debug\Controller\MigrationDebugController.
 */

namespace Drupal\d8_migrate_debug\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\migrate\Entity\Migration;
use Drupal\migrate\Entity\MigrationInterface;
use Drupal\migrate_tools\MigrateExecutable;
use Drupal\migrate\MigrateMessage;

/**
 * Class MigrationDebugController.
 *
 * @package Drupal\d8_migrate_debug\Controller
 */
class MigrationDebugController extends ControllerBase {
  /**
   * Migrate.
   *
   * @return string
   *   Return Hello string.
   */
  public function migrate() {
    //Load migration to debug.
    $migration = Migration::load('migrate_articles');

    //Reset status to idle.
    $migration->setStatus(MigrationInterface::STATUS_IDLE);

    // For update --updated
    //$migration->getIdMap()->prepareUpdate();

    $exe = new MigrateExecutable($migration, new MigrateMessage());

//  For --idlist=20,341 and --limit=10
//    $exe = new MigrateExecutable($migration, new MigrateMessage(), ['idlist' => '20,341', 'limit' => 10]);

    $exe->import();
//    or
//    $exe->rollback();

    return [
        '#type' => 'markup',
        '#markup' => $this->t('Implement method: migrate')
    ];
  }

}
