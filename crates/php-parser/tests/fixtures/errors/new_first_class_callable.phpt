===source===
<?php
new Foo(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
Cannot create Closure for new expression
===errors >=8.1===
Cannot create Closure for new expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot create Closure for new expression in Standard input code on line 2
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
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
