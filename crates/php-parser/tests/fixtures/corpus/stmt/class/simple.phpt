===source===
<?php

class A extends B implements C, D {
    const A = 'B', C = 'D';

    public $a = 'b', $c = 'd';
    protected $e;
    private $f;

    public function a() {}
    public static function b($a) {}
    final public function c() : B {}
    protected function d() {}
    private function e() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 23,
              "end": 25,
              "start_line": 3,
              "start_col": 16
            }
          },
          "implements": [
            {
              "parts": [
                "C"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 36,
                "end": 37,
                "start_line": 3,
                "start_col": 29
              }
            },
            {
              "parts": [
                "D"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 39,
                "end": 41,
                "start_line": 3,
                "start_col": 32
              }
            }
          ],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "A",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "String": "B"
                    },
                    "span": {
                      "start": 57,
                      "end": 60,
                      "start_line": 4,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 76,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "String": "D"
                    },
                    "span": {
                      "start": 66,
                      "end": 69,
                      "start_line": 4,
                      "start_col": 23
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 76,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "a",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 88,
                      "end": 91,
                      "start_line": 6,
                      "start_col": 16
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 76,
                "end": 91,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "c",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "d"
                    },
                    "span": {
                      "start": 98,
                      "end": 101,
                      "start_line": 6,
                      "start_col": 26
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 76,
                "end": 101,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "e",
                  "visibility": "Protected",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 119,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "f",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 135,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "a",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 142,
                "end": 169,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "b",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "a",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 194,
                        "end": 196,
                        "start_line": 11,
                        "start_col": 29
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 169,
                "end": 205,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "c",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 233,
                          "end": 235,
                          "start_line": 12,
                          "start_col": 32
                        }
                      }
                    },
                    "span": {
                      "start": 233,
                      "end": 235,
                      "start_line": 12,
                      "start_col": 32
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 205,
                "end": 242,
                "start_line": 12,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "d",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 242,
                "end": 272,
                "start_line": 13,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "e",
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 272,
                "end": 296,
                "start_line": 14,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 297,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 297,
    "start_line": 1,
    "start_col": 0
  }
}
