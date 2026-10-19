===source===
<?php class Foo { public static $x = 1; public function f() { return self::$x; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 38
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 56,
                      "end": 57
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 69,
                                      "end": 73
                                    }
                                  }
                                },
                                "span": {
                                  "start": 69,
                                  "end": 73
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "x"
                                },
                                "span": {
                                  "start": 75,
                                  "end": 77
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 69,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 78
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
