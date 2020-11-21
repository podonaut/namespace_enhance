<?php
namespace Podlove\Modules\NamespaceEnhance;
use \Podlove\Model;

class Namespace_Enhance extends \Podlove\Modules\Base {

    protected $module_name = 'Namespace Enhance';
    protected $module_description = 'Namespace Enhancements';
    protected $module_group = 'metadata';
    public function load() {
        $this->register_option('ns_locked', 'radio', [
            'label' => __('Locked', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => '<p>'.__('This tells other podcast platforms whether they are allowed to import this feed.', 'podlove-podcasting-plugin-for-wordpress').'</p>',
            'default' => '0',
            'options' => [
                1 => __('Enabled', 'podlove-podcasting-plugin-for-wordpress'),
                0 => __('Disabled', 'podlove-podcasting-plugin-for-wordpress'),
            ],
        ]);

        $this->register_option('ns_funding_url', 'string', [
            'label' => __('Funding:URL', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('Donation/funding links for the podcast', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_funding_string', 'string', [
            'label' => __('Funding:String', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('Message in tag', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);

        $this->register_option('ns_suggested', 'string', [
            'label' => __('Suggested', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('Suggested Amount', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_address0', 'string', [
            'label' => __('Address0', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('The lightning node address', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_name0', 'string', [
            'label' => __('Name0', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('Service Provider', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_split0', 'string', [
            'label' => __('Split0', 'podlove-podcasting-plugin-for-wordpress'),
            'description' => __('Ratio of disbursement', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_address1', 'string', [
            'label' => __('Address1', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_name1', 'string', [
            'label' => __('Name1', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_split1', 'string', [
            'label' => __('Split1', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_address2', 'string', [
            'label' => __('Address2', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_name2', 'string', [
            'label' => __('Name2', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        $this->register_option('ns_split2', 'string', [
            'label' => __('Split2', 'podlove-podcasting-plugin-for-wordpress'),
            'html' => ['class' => 'regular-text podlove-check-input'],
        ]);
        
		
		add_action('podlove_append_to_feed_head', [$this, 'add_ns_locked_to_feed'], 10, 4);
		add_action('podlove_append_to_feed_head', [$this, 'add_ns_funding_to_feed'], 10, 4);
        //add_action('podlove_append_to_feed_entry', [$this, 'add_ns_person_to_feed'], 10, 4);
        add_action('podlove_append_to_feed_head', [$this, 'add_ns_recipient_to_feed'], 10, 4);
    }

	// <podcast:locked owner="[podcast owner email address]">[yes or no]</podcast:locked>
	public function add_ns_locked_to_feed($podcast)
    {
		$ns_locked = $this->get_module_option('ns_locked');
	    if ($ns_locked)
            echo sprintf("\n\t<podcast:locked owner=\"%s\">yes</podcast:locked>", $podcast->owner_email);
        else
            echo sprintf("\n\t<podcast:locked>no</podcast:locked>");
    }

	// <podcast:locked owner="[podcast owner email address]">[yes or no]</podcast:locked>
	public function add_ns_funding_to_feed()
    {
		$ns_funding_url = $this->get_module_option('ns_funding_url');
	    if ($ns_funding_url)
            echo sprintf("\n\t<podcast:funding url=\"%s\">%s</podcast:funding>", $this->get_module_option('ns_funding_url'), $this->get_module_option('ns_funding_string'));
    }

	// <podcast:person role="[host or guest]" img="[(uri of content)]" href="[(uri to website/wiki/blog)]">[name of person]</podcast:person>
	public function add_ns_person_to_feed($podcast, $feed, $format)
    {
		$ns_locked = $this->get_module_option( 'ns_locked' );
		$hosts = [
            "Douglas Kastle",
            "Max Power",
        ];
		$guests = [
            "Jerry Seinfeld",
            "Dennis O'Brien",
        ];
	    if ($ns_locked)
            foreach ($hosts as &$host) {
				$str = "\n\t\t";
 			    $str = $str . "<podcast:person";
				$str = $str . " role=\"host\"";
				$str = $str . " img=\"\"";
				$str = $str . " href=\"\"";
				$str = $str . ">";
				$str = $str . $host;
				$str = $str . "</podcast:person>";
				echo sprintf($str);
            }
            foreach ($guests as &$guest) {
			    echo sprintf("\n\t\t<podcast:person role=\"guest\" img=\"\" href=\"\">%s</podcast:person>", $guest);
		    }
    }

	// <podcast:value type="[lightning]" method="[keysend]" suggested="[number of bitcoin(float)]">[one or more "recipientRecipient" elements]</podcast:value>
	public function add_ns_recipient_to_feed()
    {
		// This is an explict way of structure the data fetched from the
		// MySQL database variables
		$value = [
		    'type' => "lightning",
		    'method' => "keysend",
		    'suggested' => $this->get_module_option('ns_suggested'),
		];
		$recipients = [];
		$recipients[] = [ 
		    'name' => $this->get_module_option('ns_name0'),
		    'type' => "node",
		    'address' => $this->get_module_option('ns_address0'),
		    'split' => $this->get_module_option('ns_split0'),
	    ];
		$recipients[] = [ 
		    'name' => $this->get_module_option('ns_name1'),
		    'type' => "node",
		    'address' => $this->get_module_option('ns_address1'),
		    'split' => $this->get_module_option('ns_split1'),
	    ];
		$recipients[] = [ 
		    'name' => $this->get_module_option('ns_name2'),
		    'type' => "node",
		    'address' => $this->get_module_option('ns_address2'),
		    'split' => $this->get_module_option('ns_split2'),
	    ];
		
        // If there is even one recipeient we print the tag
		foreach ($recipients as &$recipient) {
	        if ($recipients['address'])
                break;			
	    }
		
		$suggested = $this->get_module_option('ns_suggested');
        $str = "\n\t";
 		$str = $str . "<podcast:value";
		$str = $str . " type=\"{$value['type']}\"";
		$str = $str . " method=\"{$value['method']}\"";
		$str = $str . " suggested=\"{$value['suggested']}\"" ;
		$str = $str . ">";
        foreach ($recipients as &$recipient) {
	        if ($recipient['address']) {
		        $str = $str . "\n\t\t";
		        $str = $str . "<podcast:valueRecipient";
		        $str = $str . " name=\"{$recipient['name']}\"";
		        $str = $str . " type=\"{$recipient['type']}\"";
		        $str = $str . " address=\"{$recipient['address']}\"";
		        $str = $str . " split=\"{$recipient['split']}\"";
		        $str = $str . " />";
	        }
		}
		$str = $str . "\n\t</podcast:value>";
	    echo sprintf($str);
   }

}
// Phase 1
// T <podcast:locked owner="[podcast owner email address]">[yes or no]</podcast:locked>
// E <podcast:transcript url="[url to a file or website]" type="[mime type]" rel="captions" language="[language code]" />
// T <podcast:funding url="[url for the show at the platform]">[user provided content to link]</podcast:funding>
// E <podcast:chapters url="[url to chapter data file]" type="[mime type]" />
// E <podcast:person role="[host or guest]" img="[(uri of content)]" href="[(uri to website/wiki/blog)]">[name of person]</podcast:person>
// E <podcast:soundbite startTime="[123]" duration="[30]">[Title of Soundbite]</podcast:soundbite>

// Phase 2
// E <podcast:location country="[Country Code]" locality="[Locality]" latlon="[latitude,longitude]" (osmid="[OSM type][OSM id]") />
// T <podcast:social platform="[service slug]" url="[link to social media account]">[social media handle]</podcast:social>
// T <podcast:category>[category Name]</podcast:category>
// <podcast:contentRating>[rating letter]</podcast:contentRating>
// <podcast:previousUrl>[url this feed was imported from]</podcast:previousUrl>
// <podcast:alternateEnclosure url="[url of media asset]" type="[mime type]" length="[(int)]" bitrate="[(float)]" title="[(string)]" rel="[(string)]" />
// <podcast:indexers> + <podcast:block>[domain, bot or service slug]</podcast:block>
// <podcast:images srcset="[url to image] [pixelwidth(int)]w, [url to image] [pixelwidth(int)]w, [url to image] [pixelwidth(int)]w, [url to image] [pixelwidth(int)]w" />
// <podcast:id platform="[service slug]" id="[platform id]" url="[link to the podcast page on the service]" />
// <podcast:contact type="[feedback or advertising or abuse]">[email address or url]</podcast:contact>
// <podcast:recipient type="[lightning]" method="[keysend]" suggested="[number of bitcoin(float)]">[one or more "recipientRecipient" elements]</podcast:recipient>
//     <podcast:recipientRecipient name="[name of recipient(string)]" type="[node]" address="[public key of bitcoin/lightning node(string)]" split="[percentage(int)]" />