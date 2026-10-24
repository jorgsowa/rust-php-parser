===source===
<?php
new array;
===errors===
expected class name, found 'array'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "array" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "array", expecting "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
