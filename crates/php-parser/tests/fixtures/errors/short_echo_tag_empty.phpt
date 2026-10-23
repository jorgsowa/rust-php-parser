===source===
<?= ?>
===errors===
expected expression, found '?>'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?>' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 4,
        "end": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 6
  }
}
