# EWOR Learning platform Roadmap

The goal of EWOR is to offer an alternative way to "learn" entrepreneurship by "learning by doing" instead of studying it in theory. To provide their participants with the needed knowledge they want to create an education platform. This platform should be additional to the working experience and contain information about topics that the participants need in their training.

This project aims to gain a deeper understanding of customer-needs and translate them into a prototype that works within the restrictions of learndash.com used to build the education platform. The focus of this project is to understand customer-needs and iterate different UI/UX to appeal to customers.

Since the time scope of the project was limited it has been decided to not implement the platform completely but focus on lower fidelity prototypes. Most important aspect of the project as already mentioned above was to gain insights into the fundamental needs and iterate prototypes to ultimately yield an optimized user experience for the final user. Nevertheless the implementation and realization of the proposed concept will be discussed in this document to propose a roadmap for the implementation of the platform.

## Learndash
[Learndash](https://www.learndash.com/) provides a _Learning Management System (LMS)_ specifically for wordpress which encorporates various features for the user such as:

- Courses
- - Course prerequisites
- - Course points
- - Certificates
- - Selling models
- - Progress
- Quizzes
- Group management

further administration has its separate tools to manage the platform:
- User profiles
- Group management
- Detailed Reporting

These features provide the core functionality of the EWOR platform. This project aims to find ways to use these features in an effective way to accompany the EWOR program and support the participants.

## Project Features
Various features have been prototyped and developed during this course. For the development and evaluation process mainly low fidelity prototypes have been used such as mocked paper prototypes with techniques such as the _the wizard of oz_. Once these features are on a certain level of satisfaction they are to be implemented into the learndash/wordpress framework. The following section gives insight about the implementation details.

### Bubble Selection
The course content should be structured in a way that participants are encouraged to discover the content and have a rather playful manner in contrast to the univerities formal approach. Therefore to present the user with topics which he is particularly interested in he gets to choose the topics he likes the most. The content is then suggested according to this selection.
To create this selection various prototypes have been created and evaluated out of which the _bubble selection_ prototype did outperform the other prototypes.

Since no viable addon/plugin for such a feature has been found work on the _bubble selection_ feature has already started and a wordpress plugin for this feature has been created.

The plugin creates a D3.js force graph which not only looks and behaves attractive but also naturally creates a dense blob of bubbles and somewhat optimizes the used space of the screen.
A database table holds the entries for this selection and allows other components to propose courses or highlight them.

### Communication Tool
The survey on communication tool has yielded interesting results. Many participants have already experienced that such a tool has not been used due to it being obsolete. While a forum or slack link can easily be provided a more sophisticated communication tool which could potentially create more helpful interaction on the platform directly would involve more implementation effort.

### 
