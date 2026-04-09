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
                          "end": 51,
                          "start_line": 3,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 51,
                      "start_line": 3,
                      "start_col": 28
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
                            "end": 63,
                            "start_line": 3,
                            "start_col": 43
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 65,
                        "start_line": 3,
                        "start_col": 36
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 71,
                "start_line": 3,
                "start_col": 4
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
                          "end": 100,
                          "start_line": 4,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 96,
                      "end": 100,
                      "start_line": 4,
                      "start_col": 29
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 108,
                "start_line": 4,
                "start_col": 4
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
                          "end": 139,
                          "start_line": 5,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 133,
                      "end": 139,
                      "start_line": 5,
                      "start_col": 29
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
                            "end": 151,
                            "start_line": 5,
                            "start_col": 45
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 153,
                        "start_line": 5,
                        "start_col": 38
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 108,
                "end": 159,
                "start_line": 5,
                "start_col": 4
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
                          "end": 189,
                          "start_line": 6,
                          "start_col": 30
                        }
                      }
                    },
                    "span": {
                      "start": 185,
                      "end": 189,
                      "start_line": 6,
                      "start_col": 30
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 193,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 194,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 194,
    "start_line": 1,
    "start_col": 0
  }
}
