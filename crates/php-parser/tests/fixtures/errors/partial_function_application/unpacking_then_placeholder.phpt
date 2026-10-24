===source===
<?php
f(...$a, ?);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
===errors >=8.6===
Cannot combine partial application and unpacking
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting ')' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?", expecting ")" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot combine partial application and unpacking in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 13
                  }
                },
                {
                  "name": null,
                  "kind": "Placeholder",
                  "span": {
                    "start": 15,
                    "end": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
