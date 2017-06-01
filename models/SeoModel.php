<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 21.07.15
 * Time: 0:16
 */

/**
 * Class SeoModel
 */
class SeoModel
{
    public $title;
    public $description;

    public $seoArr = [
        'site.whyusekangaroo' =>[
            'title' => 'Why You Should Get a Free Kangaroo.co Account Today',
            'description' => 'Discover how a free Kangaroo account can help simplify and organize your online life with one login to access all your accounts and files from any device.'
        ],
        'site.faq' =>[
            'title' => 'Answers to Frequently Asked Questions About Kangaroo.co',
            'description' => 'Learn answers to frequently asked questions about Kangaroo.co and how we can organize your online life with one login access to all your accounts and files'
        ],
        'site.feedback' =>[
            'title' => 'Give Feedback on Kangaroo.co Digital Life Services',
            'description' => 'Do you have any suggestions to improve Kangaroo.co? Let us know how we can help you manage your digital life on the go, with file access from any device.'
        ],
        'site.index' =>[
            'title' => 'Kangaroo – Login to your day',
            'description' => 'Kangaroo.co helps you manage your digital life by consolidating accounts, media, and files with secure cloud storage accessible from any device, anywhere.'
        ],
        'site.help' =>[
            'title' => 'Watch Videos for Help Learning How to Use Kangaroo.co',
            'description' => 'Need help using services on Kangaroo.co? Watch our video tutorials and learn how to use datacenter, music, social networks, virtual machine, email and more.'
        ],
        'site.about' =>[
            'title' => 'Learn About Kangaroo.co Digital Life Management Tools',
            'description' => 'Discover how Kangaroo.co solutions can help manage your digital life as we store your files and accounts securely, ready for you to access from any device.'
        ],
        'site.section1' =>[
            'title' => 'Discover Kangaroo.co Data Storage, Tasks, Social Media',
            'description' => 'Learn how Kangaroo.co helps you manage your digital life on the go with encrypted cloud data storage, social media consolidation, and task list management.'
        ],
        'site.section2' =>[
            'title' => 'Discover Kangaroo.co Virtual Machine, Calendar, Email',
            'description' => 'Learn how Kangaroo.co can help you manage your digital life on the go with virtual machine cloud computing, encrypted email account and calendar management.'
        ],
        'site.register' =>[
            'title' => 'Register at Kangaroo.co to Manage Your Digital Life',
            'description' => 'Sign up your free account on Kangaroo.co to manage your digital life on the go. Access contacts, calendars, email, media, files and more from any device.'
        ],
        'site.forgotpass' =>[
            'title' => 'Kangaroo.co Password Recovery - Recover Lost Password',
            'description' => 'Have you lost your Kangaroo.co password? Use the password recovery form to regain access to your digital files, virtual machine, cloud storage, and more.'
        ],
        'site.status' =>[
            'title' => 'Find Out the Current Status of Kangaroo.co Services',
            'description' => 'Are you having trouble using Kangaroo.co services? Find out our current system status for social networks, email, virtual machine, music, data center, more.'
        ],
        'site.terms' =>[
            'title' => 'Terms of Service',
            'description' => ''
        ],
        'site.privacy' =>[
            'title' => 'Privacy Policy',
            'description' => ''
        ]
    ];


    public function getSeo($page, $title='title', $description = 'desc')
    {
        if(isset($this->seoArr[$page])){
            $this->title = $this->seoArr[$page]['title'];
            $this->description = $this->seoArr[$page]['description'];
        } else {
            $this->title = $title;
            $this->description = $description;
        }


        return $this;
    }

}