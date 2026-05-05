===config===
min_php=8.1
===source===
<?php enum Status: string { case Active = 'a'; const DEFAULT = self::Active; const SUM = 1 + 2; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 25
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 46
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "DEFAULT",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Identifier": "self"
                          },
                          "span": {
                            "start": 63,
                            "end": 67
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "Active"
                          },
                          "span": {
                            "start": 69,
                            "end": 75
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 75
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 76
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "SUM",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 89,
                            "end": 90
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 94
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 77,
                "end": 95
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
