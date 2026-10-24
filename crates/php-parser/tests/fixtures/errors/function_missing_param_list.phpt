===source===
<?php function f {} echo 1;
===errors===
expected '(', found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "missing_param_list": true,
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 25,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
