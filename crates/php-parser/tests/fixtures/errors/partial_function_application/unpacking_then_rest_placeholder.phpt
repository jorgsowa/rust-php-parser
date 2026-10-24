===source===
<?php
A::m(...$a, ...);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
===errors >=8.6===
Cannot combine partial application and unpacking
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot combine partial application and unpacking in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
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
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 9,
                  "end": 10
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
                        "start": 14,
                        "end": 16
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 16
                  }
                },
                {
                  "name": null,
                  "kind": "SpreadPlaceholder",
                  "span": {
                    "start": 18,
                    "end": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
