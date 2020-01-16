# EWOR Learning platform Roadmap

The goal of EWOR is to offer an alternative way to "learn" entrepreneurship by "learning by doing" instead of studying it in theory. To provide their participants with the needed knowledge they want to create an education platform. This platform should be an addition to the working experience and contain information about topics that the participants need in their training.

This project aims to gain a deeper understanding of customer-needs and translate them into a prototype that works within the restrictions of learndash.com used to build the education platform. The focus of this project is to understand customer-needs and iterate different UI/UX prototypes.

Since the time scope of the project was limited it has been decided to not implement the platform completely into wordpress/learndash but focus on lower fidelity prototypes and the concept. The most important aspect of the project as already mentioned above was to gain insights into the fundamental needs and iterate prototypes to ultimately yield an optimized user experience for the final user. Nevertheless the implementation and realization of the proposed concept will be discussed in this document to provide a roadmap for the fully featured implementation of the platform.

## Wordpress
First of all the most important framework of the system should be discussed. Wordpress is very well known PHP framework and allows to build websites very quickly for an unexperienced user. This framework focuses on blogs at its core but has come a long way and allows to implement more sophisticated and custom features with the use of plugins and themes. The inexperienced user is best off taking a predefined theme which usually can be customized to some degree. This allows a very quick setup and easy to use approach at the cost of customizability. To adjust the theme to special wishes and needs changes to the theme files (PHP) are required for even minor adjustments.

Further Wordpress has a well documented developer [documentation](https://developer.wordpress.org/) which helps to develop custom wordpress plugins and themes with best practices. The documentation is often not considered as it should be when choosing such a tool.

Contrary to recent web development trends where client side rendering has become the norm with javascript frameworks like Angular, React and Vue (among many others), wordpress is a server side framework which renders html from php and serves those files to the client. Javascript libraries can nevertheless still be integrated on top of wordpress but the general approach of wordpress is server based rendering. If a more flexible API should be created a separation of the back- and frontend might be the way to go. And even in this case, wordpress has ways to achieve this in their framework.

On the other hand, developing this project with a Javascript framework requires to develop basically everything from scratch, including the backend server architecture and database structures.

### Themes
For a sophisticated website (as the learning platform will be) the best approach is to create a custom theme which is tailored to the needs of the website allowing full flexibility at the cost of having to create the theme from scratch. CSS libraries such as [Bootstrap](https://getbootstrap.com/) allow to create themes with already styled components and help optimize the website for mobile devices as well.

A second approach to a custom theme is to use a drag and drop theme builder. In the course of this project a drag and drop builder called [Elementor](https://elementor.com/) has been tested but was not flexible enough in its free version to build the adobe XD prototype as intended. These drag and drop builders are great to achieve a custom theme for users with no knowledge in web development.

## Learndash
[Learndash](https://www.learndash.com/) provides a _Learning Management System (LMS)_ specifically for wordpress which encorporates various features for the user such as:

- Modules
  - Module prerequisites
  - Module points
  - Certificates
  - Selling models
  - Progress
- Quizzes
- Group management

further administration has its separate tools to manage the platform:
- User profiles
- Group management
- Detailed Reporting

These features provide the core functionality of the EWOR platform. The concepts created in this project go beyond the possibilities of what learndash offers.
The next section gives an overview of the features needed to realize the prototype.

# Project Features
Various features have been prototyped and developed during this course. For the development and evaluation process mainly low fidelity prototypes have been used such as mocked paper prototypes with techniques such as the _the wizard of oz_. Once these features are on a certain level of satisfaction they are to be implemented into the learndash/wordpress framework. The following section gives insight about the implementation details.

## Landing Page
The landing page is the first page presented to the user after logging into the platform. Therefore this page must provide an overview of the project such as the learning progress. The detailed derivation of the landing page and its evaluation can be found in the user studies.

The landing page requires access to the following data:
- Project progress
- Started modules (which must be able to be continued)
- Suggested modules
- Mentor information (contact information)
- Progress of the modules
- Scoreboard
- Upcoming events

The already started modules, other available modules and the corresponding progress should be retrievable from learndash respectively its databases. The suggestions must be made available by the extension.

The biggest addition to the learndash functionality for the landing page would be to create a system which keeps track of the following special types of modules:
- Suggested modules based on the interest check
- Modules suggested by the mentor
- Relate a mentor to a project/person

## Mentor interaction
TODO add user management and permissions

The mentor must be able to suggest modules. This can also be realized by extending learndash. To what extent the already existing learndash _administrator_ user is suited for this interaction is still to be investigated since detailed reports might prove useful for mentors.

Further the mentor is also assigned to a project/person. This assignment is done by the EWOR program but the relation to the mentor must be available in wordpress to show his/her information and let the mentor interact with the platform.

## Leaderboard
Learndash implements a leaderboard for their quizzes. Everything which goes beyond quizzes must be again implemented in an extension even though the modules point can be taken from learndash. The leaderboard can be delayed since this feature is not a core utility but rather an addition to the user experience.

## Bubble Selection
The module content should be structured and presented in a way that participants are encouraged to discover the content and have a rather playful way to interact in contrast to the univerities' formal approach. Therefore to present the user with topics which he/she is particularly interested in an interest check lets the user make selection of the preferred topics. The content is then suggested according to this selection to encourage the user to complete modules.
To create this selection various prototypes have been created and evaluated out of which the _bubble selection_ prototype did outperform the other prototypes and can be found in the user studies resume.

Since no viable addon/plugin for such a feature has been found in wordpress a custom _bubble selection_ wordpress plugin has been created to provide the wanted user interface and experience.

The plugin creates a [D3.js](https://d3js.org/) force graph which not only looks and behaves attractive but also naturally creates a dense blob of bubbles and somewhat optimizes the used space of the screen.
A database table holds the entries for this selection and allows other components to propose modules or highlight them. This standalone plugin could also be integrated in a more extensive addon for learndash.

This feature has been tackled first to get a feel on how to implement such a plugin, to eyeball the effort needed and if we will be able to implement the prototype to wordpress/learndash. No member of the team had any real wordpress knowledge whatsoever and thus an implementation in wordpress/learndash has been considered to be infeasible. Nevertheless the interest check has been implemented as a wordpress plugin and can serve as a reference for future plugins or simply salavage the js code.

## Communication Tool
The survey on communication tool has yielded interesting results. Many participants have already experienced that such a tool has not been used due to it being obsolete. While a forum or slack link can easily be provided a more sophisticated communication tool which could potentially create more helpful interaction on the platform directly would involve more implementation effort.

The level of sophistication which is very likely needed to provide a useful communication tool on the platform also calls for a flexible system and encourages to create an extensive addon for the learndash system.
Again, this feature does not provide a core component and can be substituted in the beginning with an already existing communication tool such as the messenger [Slack](https://slack.com/intl/en-ch/) for which a [leardash addon](https://www.learndash.com/add-on/slack/) already exists.

# Resume
Even though Wordpress and learndash provide an extensive framework with a lot of features that are good to go, the available features are not flexibel enough to realize the prototype created in the _Human Computer Interaction_ course and must be extended by a custom learndash 'addon'. The following functionality must be provided by the addon:
* Mentor module
  * Overview of mentees
  * Propose modules to mentees
  * Insights
* Interest based module suggestion
  * Interest check to retrieve interests
  * Suggest modules based on interests
* (Provide a scoring system / echievements / leaderboard)
* (Provide a communication tool)

The theme and design can be implemented as a wordpress custom theme which allows to style all the contents (also the extra functionality from the extension) to yield a consistent design.
Implementing all of these features in wordpress requires quite some work and a person who is familiar with web development.
