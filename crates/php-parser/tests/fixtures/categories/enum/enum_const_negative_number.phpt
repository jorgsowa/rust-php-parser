===config===
min_php=8.1
===source===
<?php enum Numbers { const NEG_INT = -42; const NEG_FLOAT = -3.14; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Numbers",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "NEG_INT",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 38,
                            "end": 40
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 41
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "NEG_FLOAT",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Float": 3.14
                          },
                          "span": {
                            "start": 61,
                            "end": 65
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
