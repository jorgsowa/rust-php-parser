===source===
<?php
enum E {
    case X;
    const X = 1;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot redefine class constant E::X
===errors >=8.1===
Cannot redefine class constant E::X
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot redefine class constant E::X in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 26
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 41,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
