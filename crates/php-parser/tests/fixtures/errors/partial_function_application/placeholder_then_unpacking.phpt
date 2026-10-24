===source===
<?php
$o->m(?, ...$a);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
===errors >=8.6===
Cannot combine partial application and unpacking
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot combine partial application and unpacking in Standard input code on line 2
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
                  "Identifier": "m"
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": "Placeholder",
                  "span": {
                    "start": 12,
                    "end": 13
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
