===source===
<?php
class B extends A {
    private function normalPrivate() {}
    final private function finalPrivate() {}
}
class A {
    private function normalPrivate() {}
    final private function finalPrivate() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "normalPrivate",
                    "span": {
                      "start": 47,
                      "end": 60
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 65
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "finalPrivate",
                    "span": {
                      "start": 93,
                      "end": 105
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 119,
              "end": 120
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "normalPrivate",
                    "span": {
                      "start": 144,
                      "end": 157
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 127,
                "end": 162
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "finalPrivate",
                    "span": {
                      "start": 190,
                      "end": 202
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 167,
                "end": 207
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 113,
        "end": 209
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 209
  }
}
