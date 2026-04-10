===source===
<?php
class Foo {
    public function list(): array { return []; }
    public function match(): void {}
    public function class(): string { return ''; }
    public function switch(): void {}
}
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
                "Method": {
                  "name": "list",
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
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 46,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 51
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 61,
                            "end": 63
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 64
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 66
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "match",
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
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 96,
                          "end": 100
                        }
                      }
                    },
                    "span": {
                      "start": 96,
                      "end": 100
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 103
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "class",
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
                          "start": 133,
                          "end": 139
                        }
                      }
                    },
                    "span": {
                      "start": 133,
                      "end": 139
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 149,
                            "end": 151
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 152
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 108,
                "end": 154
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "switch",
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
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 185,
                          "end": 189
                        }
                      }
                    },
                    "span": {
                      "start": 185,
                      "end": 189
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 192
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 194
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 194
  }
}
