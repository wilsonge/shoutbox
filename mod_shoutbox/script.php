<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class mod_shoutboxInstallerScript
{
        function preflight( $type, $parent ) {
 
			// Module manifest file version
			$this->release = $parent->get( "manifest" )->version;
				// abort if the module being installed is not newer than the currently installed version
				if ( $type == 'Update' ) {
					$oldRelease = $this->getParam('version');
					$rel = $oldRelease . JText::_('MOD_SHOUTBOX_VERSION_TO') . $this->release;
					if ( version_compare( $this->release, $oldRelease, 'le' ) ) {
						Jerror::raiseWarning(null, JText::_('MOD_SHOUTBOX_INCORRECT_SEQUENCE') . $rel);
						return false;
					}
				}
				else { $rel = $this->release; }
		}

		function install( $parent ) {
			echo '<p>' . JText::_('MOD_SHOUTBOX_INSTALL') . '</p>';
		}

		function update( $parent ) {
			echo '<p>' . JText::_('MOD_SHOUTBOX_UPDATE') . $this->release . '</p>';
			echo '<p>' . JText::_('MOD_SHOUTBOX_UPDATE_CHANGELOG') . '</p>';
		}
		
        function getParam( $name ) {
                $db = JFactory::getDbo();
                $db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "JJ Shoutbox"');
                $manifest = json_decode( $db->loadResult(), true );
                return $manifest[ $name ];
        }
}