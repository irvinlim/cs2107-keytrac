# CS2107 3FA Demo

Submission for [CS2107 Introduction to Information and Systems Security](https://nusmods.com/modules/CS2107) project.

In our project, we recommend the adoption of Three-Factor Authentication (3FA), over the current implementations of 2FA which are prone to various types of attacks. In this prototype, we demonstrate how keystroke biometrics can be used to verify the "what you are" aspect of information security, or more specifically applied in the process of password reset mechanisms, since they are usually more prone and susceptible to attack via social engineering or other means.

## Setup Instructions

This project requires the use of [Composer](https://getcomposer.org/). To install the required dependencies, run:

```
composer install
```

### Configuration instructions

Copy `config-sample.php` to `config.php`, and fill in the configuration options as necessary.

### API instructions

This project uses the [KeyTrac API](https://www.keytrac.net/en/docs/keytrac_api) (free version) for educational purposes. Sign up for an account on KeyTrac to get 2 free users and 20 free requests per month.

After signing up, enter the API authentication token in `config.php`.

## The Team

- Chua Yu Peng
- Gabriel Sim
- Irvin Lim
- Lim Shun Yong
- Silfer Goh