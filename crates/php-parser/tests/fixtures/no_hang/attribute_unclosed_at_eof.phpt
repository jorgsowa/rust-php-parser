===source===
<?php #[ 
===errors >=8.0===
expected identifier, found end of file
expected ']', found end of file
expected declaration after attributes, found end of file
===php_error >=8.0===
PHP Parse error:  Unclosed '[' in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 9
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 8,
        "end": 8
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 8
  }
}
