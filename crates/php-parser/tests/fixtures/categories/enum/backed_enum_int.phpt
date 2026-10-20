===source===
<?php enum Status: int { case Active = 1; case Inactive = 0; }
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
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 22
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 41
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 47,
                      "end": 55
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
