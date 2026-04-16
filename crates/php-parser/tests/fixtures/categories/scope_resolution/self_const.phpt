===source===
<?php class Foo { const X = 1; public function f() { return self::X; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 30
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "f",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 60,
                                  "end": 64
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 66,
                                  "end": 67
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 67
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 68
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
