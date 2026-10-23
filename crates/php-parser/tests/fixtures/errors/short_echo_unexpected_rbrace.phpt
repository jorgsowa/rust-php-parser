===source===
<?= }
===errors===
expected expression, found '}'
expected ';' after short echo tag
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": "Error",
            "span": {
              "start": 3,
              "end": 3
            }
          }
        ]
      },
      "span": {
        "start": 0,
        "end": 3
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 3,
        "end": 3
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 3
  }
}
