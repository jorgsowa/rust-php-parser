===config===
min_php=8.3
===source===
<?php
enum Status {
    case Active;
    case Inactive;
    @invalid
    public function label(): string { return "Status"; }
}
===errors===
expected enum member, found '@'
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 5
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
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 29,
                      "end": 35
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 36
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 46,
                      "end": 54
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 41,
                "end": 55
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 89,
                      "end": 94
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 98,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 104
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": "Status"
                          },
                          "span": {
                            "start": 114,
                            "end": 122
                          }
                        }
                      },
                      "span": {
                        "start": 107,
                        "end": 123
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 125
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 127
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 127
  }
}
