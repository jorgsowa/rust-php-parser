===source===
<?php
interface HasId {
    public function getId(): int;
}
interface HasName extends HasId {
    public function getName(): string;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "HasId",
            "span": {
              "start": 16,
              "end": 21
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getId",
                    "span": {
                      "start": 44,
                      "end": 49
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
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 53,
                          "end": 56
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 56
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "HasName",
            "span": {
              "start": 70,
              "end": 77
            }
          },
          "extends": [
            {
              "parts": [
                "HasId"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 86,
                "end": 91
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getName",
                    "span": {
                      "start": 114,
                      "end": 121
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
                          "start": 125,
                          "end": 131
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 131
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 132
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 60,
        "end": 134
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134
  }
}
