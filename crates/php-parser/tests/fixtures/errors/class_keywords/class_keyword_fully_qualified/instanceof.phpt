===source===
<?php
$a instanceof \static;
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'\static' is an invalid class name
===errors >=8.0===
'\static' is an invalid class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  '\static' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "static"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 20,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
