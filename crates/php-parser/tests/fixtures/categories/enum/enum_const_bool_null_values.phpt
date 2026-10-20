===source===
<?php enum Status { const ENABLED = true; const DISABLED = false; const NOTHING = null; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast >=8.1===
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
                    "name": "ENABLED",
                    "span": {
                      "start": 26,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 36,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 41
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "DISABLED",
                    "span": {
                      "start": 48,
                      "end": 56
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 65
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "NOTHING",
                    "span": {
                      "start": 72,
                      "end": 79
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 82,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 87
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
