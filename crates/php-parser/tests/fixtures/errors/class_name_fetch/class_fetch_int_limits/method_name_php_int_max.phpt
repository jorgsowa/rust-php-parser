===source===
<?php
$o->{PHP_INT_MAX}();
===errors===
Method name must be a string
===php_error===
PHP Fatal error:  Method name must be a string in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Name": {
                    "parts": [
                      "PHP_INT_MAX"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 11,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
