===source===
<?php enum Status { final const X = 1; final public const Y = 2; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'final class constants' requires PHP 8.1 or higher
'final class constants' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 62,
                      "end": 63
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 64
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
