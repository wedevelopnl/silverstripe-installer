import Example from './example';

class App {
  constructor() {
    const example = new Example();
    example.sayHi();
    window.console.log('App constructor!');
  }
}

App();
