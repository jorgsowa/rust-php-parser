===source===
<?php enum Numbers { const PI = 3.14; const TAU = 6.28; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Numbers' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Numbers" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Numbers",
            "span": {
              "start": 11,
              "end": 18
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "PI",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "value": {
                    "kind": {
                      "Float": 3.14
                    },
                    "span": {
                      "start": 32,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "TAU",
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
                  "value": {
                    "kind": {
                      "Float": 6.28
                    },
                    "span": {
                      "start": 50,
                      "end": 54
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
