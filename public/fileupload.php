<?php
if ('POST' == $_SERVER['REQUEST_METHOD']) {
  var_dump($_FILES);
  exit(0);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/react@15.3.2/dist/react.js"></script>
    <script src="https://unpkg.com/react-dom@15.3.2/dist/react-dom.js"></script>
    <script src="https://unpkg.com/babel-core@5.8.38/browser.min.js"></script>
    <script src="https://unpkg.com/lodash@4.17.3/lodash.min.js"></script>

    <title>React App</title>
  </head>
  <body>
    <div id="root"></div>
    <script type="text/babel">
class InputFile extends React.Component {
  constructor() {
    super();

    this.onChange = this.onChange.bind(this);
  }
  onChange(e) {
    const formData = new FormData();
    formData.append('file', e.target.files[0]);

    return fetch('', { method: 'POST', body: formData})
      .then(() => window.alert('Success'))
      .catch(() => window.alert('Fail'))
    ;
  }
  render() {
    return (
      <input type="file" className="btn" onChange={this.onChange} />
    );
  }
}

ReactDOM.render(
  <InputFile />,
  document.getElementById('root')
);
    </script>
  </body>
</html>
