<?php /* Template Name: HOMEPAGE */ ?>
<?php

$TESTIMONIALS_AND_MEDIA_PATH = get_template_directory() . "/testimonials_and_media.json";
$TEAM_PATH = get_template_directory() . "/team.json";
$TESTIMONIALS_AND_MEDIA_CACHE = 0; //in seconds
$TEAM_CACHE = 0; //in seconds
function str_gettsv($input, $delimiter = "\t", $enclosure = '"', $escape = "\\")
{
    return str_getcsv($input, "\t");
}
function sortByOrder($a, $b)
{
    return strcmp($a[1], $b[1]);
}

function fetchTestimonialsAndMedia()
{
    global $TESTIMONIALS_AND_MEDIA_PATH, $TESTIMONIALS_AND_MEDIA_CACHE;
    $object = null;
    $requires_new_fetch = true;
    if (file_exists($TESTIMONIALS_AND_MEDIA_PATH)) {
        $json = file_get_contents($TESTIMONIALS_AND_MEDIA_PATH);
        $object = json_decode($json, true);
        if ($object["timestamp"] + $TESTIMONIALS_AND_MEDIA_CACHE > time()) {
            $requires_new_fetch = false;
        }
    }
    if ($requires_new_fetch) {
        if (get_field('testimonials_and_media_google_spreadsheets_url') == "") {
            return ["media" => null, "testimonials" => null];
        }
        $url_path = get_field('testimonials_and_media_google_spreadsheets_url') . '/export?format=tsv';
        $tsv = file_get_contents($url_path);
        $fetched_object = array_map("str_gettsv", explode("\n", $tsv));
        $object = [];
        $object["timestamp"] = time();
        $media = [];
        $testimonials = [];
        foreach ($fetched_object as $entry) {
            if ($entry[1] == "OCS / Media") {
                array_push($media, $entry);
            } elseif ($entry[1] == "Testimonial") {
                $exploded_name = explode("@", $entry[2]);
                $entry[2] = trim($exploded_name[0]);
                $entry[7] = trim("@" . $exploded_name[1]);
                array_push($testimonials, $entry);
            }
        }
        usort($testimonials, 'sortByOrder');
        $object["media"] = $media;
        $object["testimonials"] = $testimonials;
        $file = fopen($TESTIMONIALS_AND_MEDIA_PATH, "w");
        fwrite($file, json_encode($object));
        fclose($file);
    }
    return $object;
}
function fetchTeam()
{
    global $TEAM_PATH, $TEAM_CACHE;
    $object = null;
    $requires_new_fetch = true;
    if (file_exists($TEAM_PATH)) {
        $json = file_get_contents($TEAM_PATH);
        $object = json_decode($json, true);
        if ($object["timestamp"] + $TEAM_CACHE > time()) {
            $requires_new_fetch = false;
        }
    }
    if ($requires_new_fetch) {
        if (get_field('team_google_spreadsheets_url') == "") {
            return ["team" => null];
        }
        $url_path = get_field('team_google_spreadsheets_url') . '/export?format=tsv';
        $tsv = file_get_contents($url_path);
        $fetched_object = array_map("str_gettsv", explode("\n", $tsv));
        $object = [];
        $object["timestamp"] = time();
        $team = [];
        foreach ($fetched_object as $entry) {
            if ($entry[0] != "Timestamp") {
                array_push($team, $entry);
            }
        }
        usort($team, 'sortByOrder');
        $object["team"] = $team;
        $file = fopen($TEAM_PATH, "w");
        fwrite($file, json_encode($object));
        fclose($file);
    }
    return $object;
}
$fetched_testimonials_and_media = fetchTestimonialsAndMedia();
$fetched_testimonials = $fetched_testimonials_and_media["testimonials"];
$fetched_media = $fetched_testimonials_and_media["media"];
$fetched_team = fetchTeam()["team"];
get_header();

//svgs
$teamsvg = '
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M451.72,237.26c-17.422-8.71-50.087-8.811-51.469-8.811c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5
			c8.429,0.001,32.902,1.299,44.761,7.228c1.077,0.539,2.221,0.793,3.348,0.793c2.751,0,5.4-1.52,6.714-4.147
			C456.927,243.618,455.425,239.113,451.72,237.26z"/>
	</g>
</g>
<g>
	<g>
		<path d="M489.112,344.041l-30.975-8.85c-1.337-0.382-2.271-1.62-2.271-3.011v-10.339c2.52-1.746,4.924-3.7,7.171-5.881
			c10.89-10.568,16.887-24.743,16.887-39.915v-14.267l2.995-5.989c3.287-6.575,5.024-13.936,5.024-21.286v-38.65
			c0-4.142-3.358-7.5-7.5-7.5H408.27c-26.244,0-47.596,21.352-47.596,47.596v0.447c0,6.112,1.445,12.233,4.178,17.699l3.841,7.682
			v12.25c0,19.414,9.567,36.833,24.058,47.315l0.002,10.836c0,1.671,0,2.363-6.193,4.133l-15.114,4.318l-43.721-15.898
			c0.157-2.063-0.539-4.161-2.044-5.742l-13.971-14.678v-24.64c1.477-1.217,2.933-2.467,4.344-3.789
			c17.625-16.52,27.733-39.844,27.733-63.991v-19.678c5.322-11.581,8.019-23.836,8.019-36.457v-80.19c0-4.142-3.358-7.5-7.5-7.5
			H232.037c-39.51,0-71.653,32.144-71.653,71.653v16.039c0,12.621,2.697,24.876,8.019,36.457v16.931
			c0,28.036,12.466,53.294,32.077,69.946v25.22l-13.971,14.678c-1.505,1.581-2.201,3.679-2.044,5.742l-46.145,16.779
			c-3.344,1.216-6.451,2.863-9.272,4.858l-7.246-3.623c21.57-9.389,28.403-22.594,28.731-23.25c1.056-2.111,1.056-4.597,0-6.708
			c-5.407-10.814-6.062-30.635-6.588-46.561c-0.175-5.302-0.341-10.311-0.658-14.771c-2.557-35.974-29.905-63.103-63.615-63.103
			s-61.059,27.128-63.615,63.103c-0.317,4.461-0.483,9.47-0.658,14.773c-0.526,15.925-1.182,35.744-6.588,46.558
			c-1.056,2.111-1.056,4.597,0,6.708c0.328,0.656,7.147,13.834,28.76,23.234l-20.127,10.063C6.684,358.176,0,368.991,0,381.02
			v55.409c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5V381.02c0-6.312,3.507-11.987,9.152-14.81l25.063-12.531l8.718,8.285
			c6.096,5.793,13.916,8.688,21.739,8.688c7.821,0,15.645-2.897,21.739-8.688l8.717-8.284l8.172,4.086
			c-3.848,6.157-6.032,13.377-6.032,20.94v57.725c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725
			c0-10.296,6.501-19.578,16.178-23.097l48.652-17.691l20.253,30.381c2.589,3.884,6.738,6.375,11.383,6.835
			c0.518,0.051,1.033,0.076,1.547,0.076c4.098,0,8.023-1.613,10.957-4.546l12.356-12.356v78.124c0,4.142,3.358,7.5,7.5,7.5
			c4.142,0,7.5-3.358,7.5-7.5v-78.124l12.356,12.356c2.933,2.934,6.858,4.547,10.957,4.547c0.513,0,1.029-0.025,1.546-0.076
			c4.646-0.46,8.795-2.951,11.384-6.835l20.254-30.38l48.651,17.691c9.676,3.519,16.178,12.801,16.178,23.097v57.725
			c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725c0-10.428-4.143-20.208-11.093-27.441l1.853-0.529
			c1.869-0.534,4.419-1.265,6.979-2.52l19.149,19.149v69.066c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-69.066
			l19.016-19.016c1.011,0.514,2.073,0.948,3.191,1.267l30.976,8.85c7.07,2.02,12.009,8.567,12.009,15.921v62.044
			c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-62.044C512,360.371,502.588,347.892,489.112,344.041z M48.115,330.794
			c-14.029-5.048-21.066-11.778-24.07-15.453c2.048-5.354,3.376-11.486,4.275-17.959c4.136,9.917,11.063,18.383,19.795,24.423
			V330.794z M91.08,351.092c-6.397,6.078-16.418,6.077-22.813-0.001l-6.975-6.628c1.177-2.205,1.824-4.705,1.824-7.324v-7.994
			c5.232,1.635,10.794,2.517,16.558,2.517c5.757,0,11.316-0.886,16.557-2.512l-0.001,7.988c0,2.62,0.646,5.121,1.824,7.327
			L91.08,351.092z M79.676,316.662c-22.396,0-40.615-18.22-40.615-40.615c0-4.142-3.358-7.5-7.5-7.5c-0.42,0-0.83,0.043-1.231,0.11
			c0.022-0.645,0.043-1.291,0.065-1.93c0.167-5.157,0.328-10.028,0.625-14.206c0.958-13.476,6.343-25.894,15.163-34.968
			c8.899-9.156,20.793-14.198,33.491-14.198s24.591,5.042,33.491,14.198c8.82,9.074,14.205,21.492,15.163,34.968
			c0.296,4.177,0.458,9.047,0.628,14.203c0.015,0.443,0.03,0.892,0.045,1.338c-8.16-12.572-20.762-21.837-37.045-27.069
			c-15.043-4.833-27.981-4.534-28.527-4.52c-1.964,0.055-3.828,0.877-5.191,2.291l-13.532,14.034
			c-2.875,2.982-2.789,7.73,0.193,10.605s7.73,2.788,10.605-0.193l11.26-11.677c9.697,0.474,40.894,4.102,53.027,30.819
			C116.738,302.04,99.816,316.662,79.676,316.662z M111.229,330.819l0.001-8.945c8.725-6.007,15.662-14.457,19.801-24.449
			c0.899,6.458,2.226,12.576,4.27,17.918C132.314,318.983,125.244,325.773,111.229,330.819z M183.403,209.145v-18.608
			c0-1.129-0.255-2.244-0.746-3.261c-4.826-9.994-7.273-20.598-7.273-31.518V139.72c0-31.239,25.415-56.653,56.653-56.653h104.769
			v72.692c0,10.92-2.447,21.524-7.273,31.518c-0.491,1.017-0.746,2.132-0.746,3.261v21.355c0,20.311-8.165,39.15-22.991,53.047
			c-1.851,1.734-3.772,3.36-5.758,4.875c-0.044,0.03-0.086,0.063-0.129,0.094c-13.889,10.545-30.901,15.67-48.667,14.519
			C213.201,281.965,183.403,248.897,183.403,209.145z M225.632,360.056c-0.052,0.052-0.173,0.175-0.418,0.149
			c-0.244-0.024-0.34-0.167-0.381-0.229l-23.325-34.988l7.506-7.887l35.385,24.187L225.632,360.056z M256.095,331.113
			l-40.615-27.762v-14c10.509,5.681,22.276,9.234,34.791,10.044c1.977,0.128,3.942,0.191,5.901,0.191
			c14.341,0,28.143-3.428,40.538-9.935v13.7L256.095,331.113z M287.357,359.978c-0.041,0.062-0.137,0.205-0.381,0.229
			c-0.245,0.031-0.365-0.098-0.418-0.149l-18.767-18.767l35.385-24.188l7.507,7.887L287.357,359.978z M424.308,353.65l-17.02-17.019
			c0.297-1.349,0.465-2.826,0.464-4.455l-0.001-3.165c4.723,1.55,9.701,2.47,14.852,2.624c0.578,0.018,1.151,0.026,1.727,0.026
			c5.692,0,11.248-0.86,16.536-2.501v3.02c0,1.496,0.188,2.962,0.542,4.371L424.308,353.65z M452.591,305.196
			c-7.949,7.714-18.45,11.788-29.537,11.446c-21.704-0.651-39.361-19.768-39.361-42.613v-14.021c0-1.165-0.271-2.313-0.792-3.354
			l-4.633-9.266c-1.697-3.395-2.594-7.195-2.594-10.991v-0.447c0-17.974,14.623-32.596,32.596-32.596h64.673v31.15
			c0,5.034-1.19,10.075-3.441,14.578l-3.786,7.572c-0.521,1.042-0.792,2.189-0.792,3.354v16.038
			C464.924,287.126,460.544,297.478,452.591,305.196z"/>
	</g>
</g>
<g>
	<g>
		<path d="M472.423,380.814c-4.142,0-7.5,3.358-7.5,7.5v48.115c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-48.115
			C479.923,384.173,476.565,380.814,472.423,380.814z"/>
	</g>
</g>
<g>
	<g>
		<path d="M39.577,390.728c-4.142,0-7.5,3.358-7.5,7.5v38.201c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-38.201
			C47.077,394.087,43.719,390.728,39.577,390.728z"/>
	</g>
</g>
<g>
	<g>
		<path d="M317.532,158.475c-28.366-28.366-87.715-22.943-111.917-19.295c-7.623,1.149-13.155,7.6-13.155,15.339v17.278
			c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-17.279c0-0.255,0.168-0.473,0.392-0.507
			c9.667-1.457,28.85-3.705,48.725-2.38c23.388,1.557,40.328,7.428,50.349,17.45c2.929,2.929,7.678,2.929,10.606,0
			C320.461,166.152,320.461,161.403,317.532,158.475z"/>
	</g>
</g>
<g>
	<g>
		<path d="M167.884,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077
			C175.384,400.212,172.026,396.853,167.884,396.853z"/>
	</g>
</g>
<g>
	<g>
		<path d="M344.306,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077
			C351.806,400.212,348.448,396.853,344.306,396.853z"/>
	</g>
</g>
</svg>
';

$missionsvg = '<svg height="512pt" viewBox="-3 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m83.445312 190.390625c36.777344 0 66.695313-29.917969 66.695313-66.695313 0-36.773437-29.917969-66.695312-66.695313-66.695312-36.777343 0-66.695312 29.917969-66.695312 66.695312 0 36.777344 29.917969 66.695313 66.695312 66.695313zm0-103.390625c20.234376 0 36.695313 16.460938 36.695313 36.695312 0 20.234376-16.460937 36.695313-36.695313 36.695313-20.234374 0-36.695312-16.460937-36.695312-36.695313 0-20.234374 16.460938-36.695312 36.695312-36.695312zm0 0"/><path d="m498.605469 28.75c-43.417969-30.425781-90.1875-30.675781-142.972657-.769531-32.679687 18.515625-67.839843 19.691406-104.632812 3.542969v-16.523438c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v202.996094c-27.785156 0-146.269531-.03125-177.726562-.03125-23.441407 0-43.27734425 19.5625-43.273438 43.050781l.0195312 90.4375c0 16.558594 9.3710938 31.132813 23.5195308 38.320313l.054688 107.234374c.003906 8.28125 6.71875 14.992188 15 14.992188h89.382812c8.28125 0 15-6.71875 15-15v-189h78.023438v189c0 8.285156 6.714844 15 15 15s15-6.714844 15-15v-283.160156c14.554688 6.394531 29.507812 9.613281 44.96875 9.613281 23.535156-.003906 48.230469-7.417969 74.398438-22.242187 35.109374-19.894532 73.082031-19.777344 112.863281.335937 4.652343 2.347656 10.1875 2.117187 14.625-.609375 4.441406-2.730469 7.144531-7.566406 7.144531-12.777344v-147.128906c0-4.890625-2.386719-9.476562-6.394531-12.28125zm-281.609375 249.25h-89.015625c-8.285157 0-15 6.71875-15 15l-.003907 189h-59.390624l-.050782-102.914062c-.003906-7.3125-5.285156-13.558594-12.496094-14.78125-6.28125-1.0625-11.019531-6.589844-11.023437-12.859376 0 0-.015625-90.285156-.015625-90.4375-.003906-7.144531 6.222656-13.039062 13.273438-13.039062 31.453124 0 147.265624.027344 173.722656.03125zm138.582031-102.894531c-40.160156 22.757812-72.742187 24.394531-104.578125 4.957031v-116.257812c16.367188 5.839843 32.640625 8.890624 48.589844 9.097656 24.398437.328125 48.238281-6.019532 70.828125-18.816406 40.160156-22.757813 72.746093-24.394532 104.582031-4.957032v116.257813c-16.371094-5.839844-32.640625-8.894531-48.59375-9.097657-24.425781-.339843-48.238281 6.019532-70.828125 18.816407zm0 0"/></svg>';

$objectivesvg = '<svg xmlns="http://www.w3.org/2000/svg" height="512pt" version="1.1" viewBox="0 -3 512.00148 512" width="512pt">
<g id="surface1">
<path d="M 460.339844 337.679688 L 495.367188 302.648438 C 517.542969 280.476562 517.546875 244.394531 495.371094 222.210938 C 488.566406 215.410156 480.394531 210.632812 471.664062 207.984375 C 478.804688 198.285156 482.667969 186.609375 482.667969 174.339844 C 482.667969 159.148438 476.75 144.863281 466.003906 134.121094 C 455.265625 123.378906 440.980469 117.460938 425.785156 117.460938 C 425.148438 117.460938 424.511719 117.472656 423.875 117.492188 C 424.371094 102.308594 418.839844 86.957031 407.273438 75.386719 C 395.707031 63.824219 380.335938 58.285156 365.175781 58.789062 C 365.195312 58.15625 365.207031 57.515625 365.207031 56.878906 C 365.207031 41.683594 359.289062 27.402344 348.546875 16.660156 C 326.375 -5.511719 290.292969 -5.515625 268.109375 16.660156 L 256 28.769531 L 243.894531 16.664062 C 233.152344 5.917969 218.867188 0 203.671875 0 C 188.480469 0 174.199219 5.917969 163.457031 16.65625 C 151.886719 28.226562 146.367188 43.582031 146.871094 58.777344 C 146.230469 58.753906 145.589844 58.730469 144.949219 58.730469 C 129.757812 58.730469 115.472656 64.644531 104.722656 75.386719 C 93.15625 86.960938 87.636719 102.316406 88.140625 117.507812 C 87.496094 117.484375 86.855469 117.460938 86.210938 117.460938 C 71.019531 117.460938 56.734375 123.378906 46 134.117188 C 35.253906 144.859375 29.335938 159.144531 29.335938 174.339844 C 29.335938 186.605469 33.195312 198.28125 40.339844 207.976562 C 31.480469 210.648438 23.359375 215.484375 16.628906 222.210938 C -5.492188 244.339844 -5.542969 280.308594 16.480469 302.492188 C 16.535156 302.550781 16.589844 302.605469 16.644531 302.664062 L 51.722656 337.734375 C 51.769531 337.785156 51.820312 337.835938 51.871094 337.886719 C 53.976562 339.996094 56.226562 341.90625 58.585938 343.636719 L 48.210938 354.011719 C 38.121094 364.101562 32.980469 377.847656 33.742188 392.71875 C 34.46875 406.996094 40.613281 420.597656 51.035156 431.019531 L 110.367188 490.355469 C 121.375 501.359375 135.828125 506.863281 150.285156 506.863281 C 164.742188 506.863281 179.199219 501.359375 190.203125 490.355469 L 217.78125 462.773438 C 230.363281 465.472656 243.179688 466.84375 256.007812 466.84375 C 268.824219 466.84375 281.644531 465.480469 294.222656 462.78125 L 321.792969 490.355469 C 332.800781 501.359375 347.253906 506.863281 361.710938 506.863281 C 376.164062 506.859375 390.625 501.359375 401.628906 490.355469 L 460.964844 431.019531 C 482.972656 409.011719 485.472656 375.699219 466.535156 356.757812 L 453.898438 344.121094 L 460.132812 337.882812 C 460.203125 337.816406 460.269531 337.75 460.339844 337.679688 Z M 185.164062 38.367188 C 190.109375 33.421875 196.683594 30.699219 203.675781 30.699219 C 210.667969 30.699219 217.242188 33.421875 222.1875 38.367188 L 269.167969 85.347656 C 279.375 95.558594 279.375 112.167969 269.167969 122.375 C 264.222656 127.320312 257.648438 130.042969 250.660156 130.042969 L 250.65625 130.042969 C 243.664062 130.039062 237.09375 127.320312 232.148438 122.375 C 232.140625 122.367188 232.132812 122.359375 232.128906 122.355469 L 185.175781 75.402344 C 185.136719 75.363281 185.101562 75.324219 185.058594 75.289062 C 174.957031 65.066406 174.992188 48.535156 185.164062 38.367188 Z M 126.363281 134.050781 C 116.226562 123.835938 116.25 107.277344 126.429688 97.097656 C 131.378906 92.152344 137.957031 89.429688 144.949219 89.429688 C 151.933594 89.429688 158.5 92.148438 163.445312 97.089844 C 163.449219 97.089844 163.453125 97.09375 163.453125 97.097656 C 163.472656 97.113281 163.488281 97.128906 163.503906 97.144531 L 210.429688 144.070312 C 210.457031 144.101562 210.492188 144.132812 210.523438 144.164062 L 222.183594 155.824219 C 227.128906 160.769531 229.855469 167.34375 229.855469 174.339844 C 229.855469 181.332031 227.132812 187.90625 222.1875 192.847656 C 217.242188 197.792969 210.667969 200.515625 203.675781 200.515625 C 196.683594 200.515625 190.109375 197.792969 185.167969 192.847656 C 185.105469 192.785156 185.042969 192.726562 184.980469 192.667969 L 173.46875 181.152344 C 173.453125 181.136719 173.4375 181.121094 173.421875 181.101562 L 126.433594 134.121094 C 126.433594 134.121094 126.429688 134.117188 126.429688 134.117188 C 126.40625 134.09375 126.382812 134.070312 126.363281 134.050781 Z M 67.710938 155.824219 C 72.652344 150.882812 79.222656 148.160156 86.214844 148.160156 C 93.207031 148.160156 99.78125 150.882812 104.726562 155.828125 L 151.761719 202.863281 C 161.917969 213.074219 161.898438 229.644531 151.714844 239.835938 C 146.769531 244.777344 140.191406 247.5 133.199219 247.5 C 126.207031 247.5 119.632812 244.777344 114.691406 239.832031 C 114.628906 239.773438 114.570312 239.710938 114.507812 239.652344 L 67.855469 193 C 67.804688 192.949219 67.753906 192.894531 67.707031 192.847656 C 62.761719 187.902344 60.039062 181.332031 60.039062 174.339844 C 60.035156 167.347656 62.761719 160.773438 67.710938 155.824219 Z M 38.496094 281.101562 C 38.4375 281.039062 38.378906 280.980469 38.320312 280.921875 C 28.132812 270.714844 28.140625 254.121094 38.339844 243.921875 C 43.285156 238.976562 49.859375 236.253906 56.851562 236.253906 C 63.84375 236.253906 70.421875 238.976562 75.367188 243.925781 L 110.601562 279.15625 C 120.808594 289.363281 120.808594 305.972656 110.605469 316.179688 C 105.660156 321.125 99.085938 323.847656 92.097656 323.847656 L 92.09375 323.847656 C 90.808594 323.847656 89.539062 323.753906 88.289062 323.574219 C 88.195312 323.554688 88.101562 323.542969 88.007812 323.527344 C 82.617188 322.6875 77.640625 320.195312 73.691406 316.292969 C 73.652344 316.25 73.609375 316.210938 73.570312 316.167969 Z M 216.949219 431.035156 C 216.816406 431 216.6875 430.984375 216.558594 430.953125 C 216.25 430.878906 215.945312 430.808594 215.636719 430.753906 C 215.410156 430.714844 215.183594 430.6875 214.953125 430.65625 C 214.699219 430.625 214.445312 430.59375 214.1875 430.574219 C 213.917969 430.550781 213.648438 430.539062 213.378906 430.535156 C 213.160156 430.527344 212.945312 430.523438 212.726562 430.527344 C 212.4375 430.53125 212.152344 430.546875 211.867188 430.570312 C 211.660156 430.585938 211.453125 430.601562 211.246094 430.625 C 210.964844 430.65625 210.6875 430.699219 210.410156 430.746094 C 210.191406 430.78125 209.976562 430.824219 209.757812 430.871094 C 209.503906 430.925781 209.253906 430.984375 209.003906 431.054688 C 208.765625 431.117188 208.527344 431.1875 208.289062 431.261719 C 208.066406 431.335938 207.851562 431.414062 207.632812 431.492188 C 207.378906 431.589844 207.125 431.6875 206.878906 431.796875 C 206.679688 431.882812 206.480469 431.976562 206.285156 432.070312 C 206.035156 432.191406 205.789062 432.316406 205.546875 432.453125 C 205.347656 432.5625 205.152344 432.679688 204.957031 432.800781 C 204.738281 432.9375 204.515625 433.074219 204.300781 433.222656 C 204.082031 433.375 203.867188 433.535156 203.65625 433.699219 C 203.480469 433.832031 203.308594 433.964844 203.136719 434.105469 C 202.886719 434.316406 202.648438 434.535156 202.414062 434.761719 C 202.324219 434.847656 202.226562 434.921875 202.136719 435.011719 L 168.5 468.648438 C 158.457031 478.691406 142.121094 478.691406 132.078125 468.648438 L 72.746094 409.316406 C 67.707031 404.277344 64.742188 397.828125 64.402344 391.152344 C 64.09375 385.070312 66.050781 379.589844 69.921875 375.722656 L 91.117188 354.523438 C 91.441406 354.527344 91.765625 354.546875 92.09375 354.546875 C 92.09375 354.546875 92.09375 354.546875 92.097656 354.546875 C 107.285156 354.546875 121.566406 348.628906 132.3125 337.886719 C 148.753906 321.441406 152.992188 297.355469 145.046875 276.957031 C 155.71875 274.707031 165.527344 269.433594 173.425781 261.542969 C 182.445312 252.515625 187.796875 241.183594 189.472656 229.425781 C 194.058594 230.601562 198.820312 231.214844 203.675781 231.214844 C 203.675781 231.214844 203.675781 231.214844 203.679688 231.214844 C 218.867188 231.214844 233.148438 225.300781 243.894531 214.558594 C 254.636719 203.816406 260.554688 189.53125 260.554688 174.339844 C 260.554688 169.492188 259.945312 164.738281 258.777344 160.160156 C 270.886719 158.441406 282.074219 152.886719 290.875 144.078125 C 313.050781 121.90625 313.050781 85.824219 290.878906 63.644531 L 277.707031 50.472656 L 289.816406 38.367188 C 300.027344 28.160156 316.636719 28.160156 326.839844 38.363281 C 331.785156 43.308594 334.507812 49.882812 334.507812 56.875 C 334.507812 63.867188 331.785156 70.441406 326.839844 75.386719 C 323.84375 78.382812 322.34375 82.3125 322.34375 86.242188 C 322.34375 90.167969 323.839844 94.097656 326.839844 97.09375 C 332.835938 103.089844 342.550781 103.089844 348.546875 97.09375 C 358.75 86.890625 375.359375 86.886719 385.570312 97.09375 C 395.777344 107.304688 395.773438 123.914062 385.566406 134.121094 C 382.570312 137.117188 381.070312 141.046875 381.070312 144.972656 C 381.070312 148.902344 382.566406 152.828125 385.566406 155.824219 C 391.5625 161.820312 401.277344 161.820312 407.273438 155.828125 C 412.21875 150.882812 418.796875 148.160156 425.789062 148.15625 C 432.78125 148.15625 439.355469 150.878906 444.296875 155.824219 C 449.246094 160.773438 451.96875 167.347656 451.96875 174.339844 C 451.96875 181.238281 449.316406 187.730469 444.496094 192.648438 C 444.425781 192.71875 444.355469 192.785156 444.289062 192.855469 L 422.277344 214.871094 C 416.796875 220.351562 416.261719 229.058594 421.03125 235.167969 L 421.820312 236.179688 C 426.578125 242.277344 435.132812 243.878906 441.773438 239.921875 C 452.066406 233.789062 465.179688 235.433594 473.664062 243.914062 C 483.871094 254.125 483.871094 270.734375 473.664062 280.941406 L 438.433594 316.167969 C 438.367188 316.238281 438.296875 316.308594 438.230469 316.378906 L 362.609375 392 C 324.667969 429.941406 268.855469 444.898438 216.949219 431.035156 Z M 444.832031 378.464844 C 451.5625 385.199219 448.960938 399.617188 439.261719 409.316406 L 379.925781 468.648438 C 369.882812 478.691406 353.546875 478.691406 343.503906 468.648438 L 327.175781 452.320312 C 348.398438 443.261719 367.835938 430.1875 384.316406 413.707031 L 432.191406 365.828125 Z M 444.832031 378.464844 " style=" stroke:none;fill-rule:nonzero;fill-opacity:1;" />
</g>
</svg>';

//translation
$sendmessage = 'Enviar mensagem';
$seemore = "Ver mais";
$assine = "Assine a nossa newsletter";
$titulo_about_us = "Entre em contacto";


if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') {
    $sendmessage = 'Send message';
    $seemore = "See more";
    $assine = "Subscribe our newsletter";
    $titulo_about_us = "Contact us";
}

//Top header content
$phrases = get_field('phrases');
$header_title = get_field('header_title');
//mobile ou desktop
$listimagesheader =  wp_is_mobile() ? get_field('images_mobile') : get_field('images_desktop');
$header_image = wp_get_attachment_image($listimagesheader[mt_rand(0, count($listimagesheader)-1)]['ID'], 'full');
$header_description = $phrases[mt_rand(0, count($phrases)-1)]['phrases'];
//echo "<pre>".print_r($titleheader,true)."</pre>";


$args = array(
    // Whether the title should be displayed or not (true/false)
    'display_title' => false,
    // Whether the description should be displayed or not (true/false)
    'display_description' => false,
    // Text used for the submit button
    'submit_text' => $sendmessage,
    // The URL to which the form points. Defaults to the current URL which will automatically display a success message after submission
    // If this is overriden you may use af_has_submission to check for a form submission
    'target' => '',
    // Whether the form output should be echoed or returned
    'echo' => false,
    // Field values to pre-fill. Should be an array with format: $field_name_or_key => $field_prefill_value
    'values' => array(),
    // Array of field keys or names to exclude from form rendering
    'exclude_fields' => array(),
    // Either 'wp' or 'basic'. Whether to use the Wordpress media uploader or a regular file input for file/image fields.
    'uploader' => 'wp',
    // The URL to redirect to after a successful submission. Defaults to false for no redirection.
    'redirect' => false,
     'recaptcha' => true         // recaptcha
);

$acf_form_id = get_field('acf_form_id');
$contactform = advanced_form($acf_form_id, $args);

//get 3 most recent posts
$maximopaginas = 3;
//global $query_string;
$query_string = query_posts('posts_per_page='.$maximopaginas);



//information about vost
$infovost = get_field('vost_info');
$column1title = get_field('column1')['title'];
$column1desc = get_field('column1')['description'];
$column2title = get_field('column2')['title'];
$column2desc = get_field('column2')['description'];
$column3title = get_field('column3')['title'];
$column3desc = get_field('column3')['description'];
//echo "<pre>".var_dump($infovost, true)."</pre>";

//featured post
$featured_article = get_field('featured_article');
$featured_content = get_field('featured_content');

$featured_image = get_the_post_thumbnail($featured_article[0]);
$featured_link = get_permalink($featured_article[0]);
$featured_title = get_the_title($featured_article[0]);

//team
$team_title = get_field('team_title');
$team_description = get_field('team_description');
$htmlmembers = "";
if ($fetched_team) {
    foreach ($fetched_team as $member) {
        $name = $member[1];
        $type = $member[2];
        $description = $member[3];
        $image = '<img src="'.$member[4].'" class="attachment-medium size-medium" alt="" width="300" height="300">';
        $htmlmembers .= '<div class="team" >
        <div class="team__image">'.$image.'</div>
        <div class="team__name">'.$name.'</div>
        <div class="team__handle">'.$type.'</div>
        <div class="team__text">'.$description.'</div>
    </div>';
    }
}

//testimonials
$testimonials_title = get_field('testimonials_title');
$testimonials_description = get_field('testimonials_description');
$htmltestimonials = "";
if ($fetched_testimonials) {
    foreach ($fetched_testimonials as $testimonial) {
        $name = $testimonial[2];
        $handle = $testimonial[7];
        $description = $testimonial[4];
        $image = '<img src="'.$testimonial[5].'" class="attachment-medium size-medium" alt="" width="300" height="300">';
        $htmltestimonials .= '<div class="testimonial" >
                      <div class="testimonial__image">'.$image.'</div>
                      <div class="testimonial__name">'.$name.'</div>
                      <div class="testimonial__handle">'.$handle.'</div>
                      <div class="testimonial__text">'.$description.'</div>
                  </div>';
    }
}

//media
$media_title = get_field('media_title');
$media_description = get_field('media_description');
$htmlmedia = "";
if ($fetched_media) {
    foreach ($fetched_media as $media) {
        $name = $media[2];
        $date = $media[3];
        $description = $media[4];
        $link = $media[6];
        $image = '<img src="'.$media[5].'" class="attachment-medium size-medium" alt="" width="300" height="300">';
        $htmlmedia .= '<div class="media_entry" >
                      <div class="media_entry__image">'.$image.'</div>
                      <div class="media_entry__name">'.$name.'</div>
                      <div class="media_entry__handle">'.$date.'</div>
					  <div class="media_entry__handle"><a  target="_blank" rel="noopener noreferrer" href="'.$link.'">Link</a></div>
                      <div class="media_entry__text">'.$description.'</div>
                  </div>';
    }
}

//LATEST POSTS
$latest_posts_title = get_field('latest_posts_title');
$latest_posts_description = get_field('latest_posts_description');

//contacto
$contact_description = get_field('contact_description');
//$contactosup = get_field('contactos_superior');
//$contactosdown = get_field('contactos_inferior');

$contact_form_title = get_field('contact_form_title');

//imagem contacts
$contact_image = wp_get_attachment_image(get_field('contact_image'), 'full');
$newsletter_image = wp_get_attachment_image(get_field('newsletter_image'), 'full');



//apanhar os 3 posts mais recentes
global $wp_query;
$blogposts = "";
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $title = esc_html($post->post_title);
        //$data = date('d.m.Y', strtotime($post->post_date));
      
        $image =  get_the_post_thumbnail_url($post);
        $link = get_permalink($post->ID);
        $brief = esc_html(get_the_excerpt($post->ID));
        $blogposts .= '<!--post-->
                    <div class="blog-post">
                      <a href="'.$link.'" class="image" title="'.$title.'"><img src="'.$image.'" alt="'.$title.'"></a>
                      <a class="title" title="'.$title.'" href="'.$link.'">'.$title.'</a>
                      <div class="description"><p>'.$brief.'</p></div>
                    </div>
                    <!-- end post -->';
    }
}

?>
<!--top header -->
<section class="topcontent">
  <?php echo $header_image; ?>
  <div class="topcontent__info">
    <div class="headline"><?php echo $header_title; ?></div>
    <p class="subtitle"><?php echo $header_description; ?></p>
  </div>
</section>
<!-- main content -->
<section class="main-content">
<!-- info projecto -->
<section class="projectinfo">
  <div class="projectinfo__wrap withmargins">
    <p class="geral"><?php echo $infovost; ?></p>
    <div class="projectinfo__sections">
      <!--team-->
      <div class="section">
        <div class="section__image"><?php echo $teamsvg; ?></div>
        <div class="section__title"><?php echo $column1title; ?></div>
        <div class="section__description"><?php echo $column1desc; ?></div>
      </div>
      <!--missao -->
      <div class="section">
        <div class="section__image"><?php echo $missionsvg; ?></div>
        <div class="section__title"><?php echo $column2title; ?></div>
        <div class="section__description"><?php echo $column2desc; ?></div>
      </div>
      <!--objectivo-->
      <div class="section">
        <div class="section__image"><?php echo $objectivesvg; ?></div>
        <div class="section__title"><?php echo $column3title; ?></div>
        <div class="section__description"><?php echo $column3desc; ?></div>
      </div>
    </div>
  </div>
</section>
<!--destaque -->
<?php if ($featured_article) {
    ?>
<section class="destaque">
  <div class="destaque__image"><?php echo $featured_image; ?></div>
  <div class="destaque__wrap withmargins">
    <div class="title"><?php echo $featured_title; ?></div>
    <div class="freecontent"><?php echo $featured_content; ?> </div>
    <a class="link" href="<?php echo $featured_link; ?>"><?php echo $seemore; ?></a>
  </div>
</section>
<?php
} ?>
<!--equipa-->
<?php if ($fetched_team) {
        ?>
<section class="teams" >
  <h2><?php echo $team_title; ?></h2>
  <div class="geral"><?php echo $team_description; ?></div>
  <div class="teams__wrap withmargins" id="sliderteam"><?php echo $htmlmembers; ?></div>
 <div class="prev"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                           C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                           c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                           l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                       </g>
                     </g>
                     </svg></div>
  <div class="next"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                           c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                           c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                           c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                       </g>
                     </g>
                     </svg></div>
</section>
<?php
    } ?>
<!--testemunhos -->
<?php if ($fetched_testimonials) {
        ?>
<section class="testimonials" >
  <h2><?php echo $testimonials_title; ?></h2>
  <div class="geral"><?php echo $testimonials_description; ?></div>
  <div class="testimonials__wrap withmargins" id="slidertestimonials"><?php echo $htmltestimonials; ?></div>
 <div class="prev"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                           C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                           c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                           l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                       </g>
                     </g>
                     </svg></div>
  <div class="next"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                           c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                           c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                           c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                       </g>
                     </g>
                     </svg></div>
</section>
<?php
    } ?>
<!--media -->
<?php if ($fetched_media) {
        ?>
<section class="media_entries" >
  <h2><?php echo $media_title; ?></h2>
  <div class="geral"><?php echo $media_description; ?></div>
  <div class="media_entries__wrap withmargins" id="slidermedias"><?php echo $htmlmedia; ?></div>
 <div class="prev"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                           C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                           c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                           l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                       </g>
                     </g>
                     </svg></div>
  <div class="next"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve" fill="#ffffff">
                     <g>
                       <g>
                         <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                           c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                           c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                           c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                       </g>
                     </g>
                     </svg></div>
</section>
<?php
    }
//translation
$subscribe_to_our_newsletter = "Mantêm te atualizado, subscreve a nossa mailing list!";
$thank_you_newsletter = "Obrigado pela tua subscrição! Assim não perderás nenhuma informação!";


if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') {
    $subscribe_to_our_newsletter = "Keep updated, subscribe to our mailing list!";
    $thank_you_newsletter = "Thank you for you subscription! This way you will not lose any information!";
}
    
?>
<!--newsletter -->
<div class="newsletter">
	<div class="newsletter__image"><?php echo $newsletter_image; ?></div>
	<div class="newsletter__title">
		<h3 style="font-size: 1.2rem;border-radius: .3rem;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;background-color: #d80917;color: #f8f8f8;padding: 15px 25px;z-index: 11;margin-bottom: -2.5vh;">
			Newsletter
		</h3>
		<div class="validate subscribe-form form-inline justify-content-center" id="subscribers_signup" style="text-align:center; z-index:10;">
			<div class="form-group" style="min-width: 400px;padding: 25px;background-color: #f8f8f8;border-radius: .3rem;">
				<p style="color: #333;margin-top: 2vh;">
					<?= $subscribe_to_our_newsletter ?>
				</p>
				<input type="email" id="email_signup" value="" class="email" required="" name="email" placeholder="Insere o teu email" required style="width: 100%;padding: 3px 5px;resize: none;margin: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 14px;line-height: 1.4;margin-bottom: 7.5%;border: 0;border-bottom-color: currentcolor;border-bottom-style: none;border-bottom-width: 0px;background-color: transparent;border-bottom: 1px solid #4d4d4d;margin-top: 2vh;"><br/>
				<a href="#subscribers_complete" onclick="subscribeEmail()" value="Subscribe" name="subscribe" style="background-color: #d80917;color: #f8f8f8;padding: 15px 25px;border-radius: .3rem;text-decoration: none;">SUBSCREVE</a>
			</div>
		</div>
		<div class="validate subscribe-form form-inline justify-content-center"  id="subscribers_complete" style="text-align:center; z-index:10; display: none;">
			<div class="form-group" style="min-width: 400px;padding: 25px;background-color: #f8f8f8;border-radius: .3rem;">
				<p style="color: #333;margin-top: 1vh;"><?= $thank_you_newsletter ?></p>
			</div>
		</div>
	</div>
</div>
<!-- recent blog -->
<div class="blog">
  <h2><?php echo $latest_posts_title; ?></h2>
  <div class="geral"><?php echo $latest_posts_description; ?></div>
  <div class="blog__wrap withmargins">
    <?php echo $blogposts; ?>
  </div>
</div>
<!--contact form -->
<div class="contactform">
  <div class="contactform__image"><?php echo $contact_image; ?></div>
  <div class="contactform__wrap withmargins">
    <div class="contactform-left">
      <?php echo $contact_description; ?>
    </div>
    <div class="contactform-right">
      <h3><?php echo $contact_form_title; ?></h3>
      <?php echo $contactform; ?>
    </div>
  </div>
</div>
<!-- scripts e css -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/home.js"></script>

<?php get_footer(); ?>