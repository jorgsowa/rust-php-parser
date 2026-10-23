===source===
<?php enum Status { #[SomeAttr] const X = 1; }
===errors <=7.4===
'enums' requires PHP 8.1 or higher
missing closing '}'
===errors 8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast <=7.4===
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
          "members": [],
          "attributes": []
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
===ast >=8.0===
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
                      "start": 38,
                      "end": 39
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "SomeAttr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 30
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 30
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 32,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
