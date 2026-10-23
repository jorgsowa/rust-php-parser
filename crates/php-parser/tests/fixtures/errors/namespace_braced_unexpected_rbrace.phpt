===source===
<?php namespace {} }
===errors===
expected expression, found '}'
No code may exist outside of namespace {}
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 18,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
