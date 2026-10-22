===source===
<?php
class A {
    private function normalPrivate() {}
    final private function finalPrivate() {}
}
class B extends A {
    private function normalPrivate() {}
    final private function finalPrivate() {}
}
===php_error <=7.4===
PHP Fatal error:  Cannot override final method A::finalPrivate() in Standard input code on line 8
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "normalPrivate",
                    "span": {
                      "start": 37,
                      "end": 50
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
                "start": 20,
                "end": 55
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "finalPrivate",
                    "span": {
                      "start": 83,
                      "end": 95
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
                "start": 60,
                "end": 100
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 102
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 109,
              "end": 110
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
              "start": 119,
              "end": 120
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
        "start": 103,
        "end": 209
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 209
  }
}
