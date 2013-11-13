<?php 
/**
 * PHPProject
 *
 * Copyright (c) 2012 - 2012 PHPProject
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category	PHPProject
 * @package	PHPProject
 * @copyright	Copyright (c) 2012 - 2012 PHPProject (https://github.com/PHPOffice/PHPProject)
 * @license	http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version	##VERSION##, ##DATE##
 */

namespace PHPProject\Writer;

/**
 * PHPProject_Writer_GanttProject
 *
 * @category	PHPProject
 * @package	PHPProject
 * @copyright	Copyright (c) 2012 - 2012 PHPProject (https://github.com/PHPOffice/PHPProject)
 */
class GanttProject {
	/**
	 * PHPProject object
	 *
	 * @var PHPProject
	 */
	private $_phpProject;
	
	/**
	 * 
	 * @var array
	 */
	private $_arrAllocations;
	
	
	/**
	 * Create a new PHPProject_Writer_GanttProject
	 *
	 * @param	PHPProject	$phpProject	PHPProject object
	 */
	public function __construct(\PHPProject $phpProject) {
		$this->_phpProject	= $phpProject;
		$this->_arrAllocations = array();
	}
	
	public function save($pFilename = null){
		$arrProjectInfo = $this->_sanitizeProject();
		
		// Create XML Object 
		$oXML = new \PHPProject\Shared\XMLWriter(\PHPProject\Shared\XMLWriter::STORAGE_DISK);
		$oXML->startDocument('1.0','UTF-8');
		// project
		$oXML->startElement('project');
		if(isset($arrProjectInfo['date_start']) && $arrProjectInfo['date_start'] != 0){
			$oXML->writeAttribute('view-date', date('Y-m-d', $arrProjectInfo['date_start']));
		}
		$oXML->writeAttribute('version', '2.0');
		
			// view
			$oXML->startElement('view');
				$oXML->writeAttribute('id', 'resource-table');
			
				// field
				$oXML->startElement('field');
				$oXML->writeAttribute('id', '0');
				$oXML->writeAttribute('name', 'Nom');
				$oXML->writeAttribute('width', '56');
				$oXML->writeAttribute('valuetype', '0');
				$oXML->endElement();
				
				$oXML->startElement('field');
				$oXML->writeAttribute('id', '1');
				$oXML->writeAttribute('name', 'Rôle par défaut');
				$oXML->writeAttribute('width', '43');
				$oXML->writeAttribute('valuetype', '1');
				$oXML->endElement();
				
			// >view
			$oXML->endElement();
			
			// tasks
			$oXML->startElement('tasks');
			
				// tasksproperties
				$oXML->startElement('tasksproperties');
				
					// taskproperty
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd0');
					$oXML->writeAttribute('name', 'type');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'icon');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd1');
					$oXML->writeAttribute('name', 'priority');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'icon');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd2');
					$oXML->writeAttribute('name', 'info');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'icon');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd3');
					$oXML->writeAttribute('name', 'name');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'text');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd4');
					$oXML->writeAttribute('name', 'begindate');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'date');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd5');
					$oXML->writeAttribute('name', 'enddate');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'date');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd6');
					$oXML->writeAttribute('name', 'duration');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'int');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd7');
					$oXML->writeAttribute('name', 'completion');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'int');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd8');
					$oXML->writeAttribute('name', 'coordinator');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'text');
					$oXML->endElement();
					
					$oXML->startElement('taskproperty');
					$oXML->writeAttribute('id', 'tpd9');
					$oXML->writeAttribute('name', 'predecessorsr');
					$oXML->writeAttribute('type', 'default');
					$oXML->writeAttribute('valuetype', 'text');
					$oXML->endElement();
					// >taskproperty
					
				// >tasksproperties
				$oXML->endElement();
				
				// task
				$arrTasks = $this->_phpProject->getAllTasks();
				$iTaskIndex = 0;
				foreach ($arrTasks as $oTask){
					$iTaskIndex = $this->_writeTask($oXML, $oTask, $iTaskIndex);
				}
			
			// >tasks
			$oXML->endElement();
			
			// resources
			$oXML->startElement('resources');
			
				// resource
				$arrResources = $this->_phpProject->getAllResources();
				$iResourceIndex = 0;
				foreach ($arrResources as $oResource){
					$this->_writeResource($oXML, $oResource);
				}
			
			
			// >resources
			$oXML->endElement();
				
			// allocations
			$oXML->startElement('allocations');
			
			if(count($this->_arrAllocations) > 0){
				foreach ($this->_arrAllocations as $itmAllocation){
					$this->_writeAllocation($oXML, $itmAllocation['id_task'], $itmAllocation['id_res']);
				}
			}
				
			// >allocations
			$oXML->endElement();			
			
			// taskdisplaycolumns
			$oXML->startElement('tasksproperties');
			
				// displaycolumn
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd2');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd7');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd6');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd10');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd1');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd9');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd8');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd0');
				$oXML->writeAttribute('order', '-1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'false');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd3');
				$oXML->writeAttribute('order', '0');
				$oXML->writeAttribute('width', '199');
				$oXML->writeAttribute('visible', 'true');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd4');
				$oXML->writeAttribute('order', '1');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'true');
				$oXML->endElement();
				
				$oXML->startElement('displaycolumn');
				$oXML->writeAttribute('property-id', 'tpd5');
				$oXML->writeAttribute('order', '2');
				$oXML->writeAttribute('width', '75');
				$oXML->writeAttribute('visible', 'true');
				$oXML->endElement();
				// >displaycolumn
				
			// >taskdisplaycolumns
			$oXML->endElement();
			
		// >project
		$oXML->endElement();
		
		// Writing XML Object in file
		// Open file
		$fileHandle = fopen($pFilename, 'wb+');
		if ($fileHandle === false) {
			throw new \Exception("Could not open file $pFilename for writing.");
		}
		// Write XML Content
		fwrite($fileHandle, $oXML->getData());
		
		// Close file
		fclose($fileHandle);
	}

	private function _writeTask(\PHPProject\Shared\XMLWriter $oXML, \PHPProject\Task $oTask, $iNbTasks){
		++$iNbTasks;
		$oXML->startElement('task');
		$oXML->writeAttribute('id', $iNbTasks);
		$oXML->writeAttribute('name', $oTask->getName());
		$oXML->writeAttribute('start', date('Y-m-d',$oTask->getStartDate()));
		$oXML->writeAttribute('duration',$oTask->getDuration());
		$oXML->writeAttribute('complete',$oTask->getProgress()*100);
		$oXML->writeAttribute('meeting', 'false');
		$oXML->writeAttribute('expand', 'true');
		
		// Resources Allocations
		if($oTask->getResourceCount() > 0){
			$arrResources = $oTask->getResources();
			foreach ($arrResources as $resourceIdx){
				$itmAllocation = array();
				$itmAllocation['id_res'] = $resourceIdx;
				$itmAllocation['id_task'] = $iNbTasks;
				$this->_arrAllocations[] = $itmAllocation;
			}
		}

		// Children
		if($oTask->getTaskCount() > 0){
			$arrTasksChilds = $oTask->getTasks();
			foreach ($arrTasksChilds as $oTaskChild){
				$iNbTasks = $this->_writeTask($oXML, $oTaskChild, $iNbTasks);
			}
		} else {
			// Nothing
		}
		$oXML->endElement();
		
		return $iNbTasks;
	}
	
	private function _writeResource(\PHPProject\Shared\XMLWriter $oXML, \PHPProject\Resource $oResource){
		$oXML->startElement('resource');
		$oXML->writeAttribute('id', $oResource->getIndex());
		$oXML->writeAttribute('name', $oResource->getTitle());
		$oXML->writeAttribute('function', 'Default:0');
		$oXML->writeAttribute('contacts', '');
		$oXML->writeAttribute('phone', '');
		$oXML->endElement();
	}
	
	private function _writeAllocation(\PHPProject\Shared\XMLWriter $oXML, $piIdTask, $piIdResource){
		$oXML->startElement('allocation');
		$oXML->writeAttribute('task-id', $piIdTask);
		$oXML->writeAttribute('resource-id', $piIdResource);
		$oXML->writeAttribute('function', 'Default:0');
		$oXML->writeAttribute('responsible', 'true');
		$oXML->writeAttribute('load', '100.0');
		$oXML->endElement();
	}
	
	private function _sanitizeProject(){
		// Info Project
		$minDate = 0;
		// Browse all tasks 
		$arrTasks = $this->_phpProject->getAllTasks();
		$iTaskIndex = 0;
		foreach ($arrTasks as $oTask){
			if($oTask->getTaskCount() == 0){
				$this->_sanitizeTask($oTask);
			} else {
				$this->_sanitizeTaskParent($oTask);
			}
			$tStartDate = $oTask->getStartDate();
			if($minDate == 0 || $tStartDate < $minDate){
				$minDate = $tStartDate;
			}
		}

		return array('date_start' => $minDate);
	}
	
	/**
	 * Permits to clean a task
	 * - If the duration is not filled, but the end date is, we calculate it.
	 * - If the end date is not filled, but the duration is, we calculate it.
	 * @param PHPProject_Task $oTask
	 */
	private function _sanitizeTask(\PHPProject\Task $oTask){
		$pDuration = $oTask->getDuration();
		$pEndDate = $oTask->getEndDate();
		$pStartDate = $oTask->getStartDate();
		
		if($pDuration == null and $pEndDate > 0){
			$iTimeDiff = $pEndDate - $pStartDate;
			$iNumDays = $iTimeDiff / 60 / 60 / 24;
			$oTask->setDuration($iNumDays + 1);
		}
		elseif($pDuration != null and $pEndDate = 0){
			$oTask->setEndDate($pStartDate + ($pDuration * 24 * 60 * 60));
		}
	}
	
	/**
	 * Permits to clean parent task and calculate parent data like total duration,
	 *   date start and complete average.
	 * @param PHPProject_Task $oParentTask
	 */
	private function _sanitizeTaskParent(\PHPProject\Task $oParentTask){
		$arrTasksChilds = $oParentTask->getTasks();

		$iProgress = 0;
		$tStartDate = null;
		$tEndDate = null;
		foreach ($arrTasksChilds as $oTaskChild){
			if($oTaskChild->getTaskCount() == 0){
				$this->_sanitizeTask($oTaskChild);
			} else {
				$this->_sanitizeTaskParent($oTaskChild);
			}
			
			$iProgress += $oTaskChild->getProgress();
			if(is_null($tStartDate)){
				$tStartDate = $oTaskChild->getStartDate();
			}
			elseif ($tStartDate > $oTaskChild->getStartDate()) {
				$tStartDate = $oTaskChild->getStartDate();
			}
			
			if(is_null($tEndDate)){
				$tEndDate = $oTaskChild->getEndDate();
			}
			elseif ($tEndDate < $oTaskChild->getEndDate()) {
				$tEndDate = $oTaskChild->getEndDate();
			}
		}
		$oParentTask->setProgress($iProgress / $oParentTask->getTaskCount());
		$oParentTask->setStartDate($tStartDate);
		$oParentTask->setEndDate($tEndDate);
		$oParentTask->setDuration((($tEndDate - $tStartDate)  / 60 / 60 / 24 ) + 1);
	}
}
