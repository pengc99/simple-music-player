<?

/*
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$domain = "http://your.domain.com/";

$musicDirectory = "public_facing_path"; 
# If the path to get to your script where http://my.domain.com/music/
# this value would be "music"

$playerDirectory = "player";
# Shouldn't need to touch this

$playTrack = $_GET['playtrack'];
$streamTrack = $_GET['streamtrack'];
$files = scandir(".");
$count = count($files);

echo "<html>\n";
echo "<head>\n";
echo "<title>doing the needful...</title>\n";
echo "<script type=\"text/javascript\" src=\"".$playerDirectory."/audio-player.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "AudioPlayer.setup(\"".$domain.$musicDirectory."/".$playerDirectory."/player.swf\", {\n";
echo "	width: 400\n";
echo "});\n";
echo "</script>\n";
echo "</head>\n\n";
echo "<body>\n";

echo "<a href = \"".$domain.$musicDirectory."\">Home</a><br />\n";
echo "Total tracks: ".($count+1)."\n"; 

if ($playTrack)
{
	echo "<br /><br />";
	echo "<p id=\"audioplayer_1\">Alternative content</p>\n";
	echo "<script type=\"text/javascript\">\n";
	echo "AudioPlayer.embed(\"audioplayer_1\", {\n";
	echo "	autostart: \"yes\",\n";
	echo "	remaining: \"yes\",\n";
	echo "	titles: \"".$playTrack."\",\n";
	echo "	soundFile: \"".$domain.$musicDirectory."/".$playTrack."\"\n";
	echo "});\n";
	echo "</script>\n";
}

echo "<pre>\n";
for ($i = 0; $i < $count; $i++)
{
	if (strtolower(substr(strrev($files[$i]),0,3)) == "3pm")
	{
		echo "<a href = \"".$domain.$musicDirectory."/index.php?playtrack=".urlencode($files[$i])."\">PLAY</a>|<a href = \"".$domain.$musicDirectory."/".urlencode($files[$i])."\">DOWNLOAD</a> :: ";
		if (($playTrack) && ($playTrack == $files[$i]))
		{
			echo "<b>";
		}
		echo "$files[$i]\n";
                if (($playTrack) && ($playTrack == $files[$i]))
                {
                        echo "</b>";
                }
	}
}
echo "</pre>\n";
echo "</body>\n";
echo "</html>";
?>
