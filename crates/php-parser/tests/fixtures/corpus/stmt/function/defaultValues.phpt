===source===
<?php

function a(
    $b = null,
    $c = 'foo',
    $d = A::B,
    $f = +1,
    $g = -1.0,
    $h = array(),
    $i = [],
    $j = ['foo'],
    $k = ['foo', 'bar' => 'baz']
) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [
            {
              "name": "b",
              "type_hint": null,
              "default": {
                "kind": "Null",
                "span": {
                  "start": 28,
                  "end": 32,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 23,
                "end": 32,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "name": "c",
              "type_hint": null,
              "default": {
                "kind": {
                  "String": "foo"
                },
                "span": {
                  "start": 43,
                  "end": 48,
                  "start_line": 5,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 38,
                "end": 48,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "name": "d",
              "type_hint": null,
              "default": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 59,
                        "end": 60,
                        "start_line": 6,
                        "start_col": 9
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 59,
                  "end": 63,
                  "start_line": 6,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 54,
                "end": 63,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "name": "f",
              "type_hint": null,
              "default": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 75,
                        "end": 76,
                        "start_line": 7,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 74,
                  "end": 76,
                  "start_line": 7,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 69,
                "end": 76,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "name": "g",
              "type_hint": null,
              "default": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Float": 1.0
                      },
                      "span": {
                        "start": 88,
                        "end": 91,
                        "start_line": 8,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 91,
                  "start_line": 8,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 82,
                "end": 91,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "name": "h",
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 102,
                  "end": 109,
                  "start_line": 9,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 97,
                "end": 109,
                "start_line": 9,
                "start_col": 4
              }
            },
            {
              "name": "i",
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 120,
                  "end": 122,
                  "start_line": 10,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 115,
                "end": 122,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "name": "j",
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "String": "foo"
                        },
                        "span": {
                          "start": 134,
                          "end": 139,
                          "start_line": 11,
                          "start_col": 10
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 134,
                        "end": 139,
                        "start_line": 11,
                        "start_col": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 133,
                  "end": 140,
                  "start_line": 11,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 128,
                "end": 140,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "name": "k",
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "String": "foo"
                        },
                        "span": {
                          "start": 152,
                          "end": 157,
                          "start_line": 12,
                          "start_col": 10
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 152,
                        "end": 157,
                        "start_line": 12,
                        "start_col": 10
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "bar"
                        },
                        "span": {
                          "start": 159,
                          "end": 164,
                          "start_line": 12,
                          "start_col": 17
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "baz"
                        },
                        "span": {
                          "start": 168,
                          "end": 173,
                          "start_line": 12,
                          "start_col": 26
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 159,
                        "end": 173,
                        "start_line": 12,
                        "start_col": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 151,
                  "end": 174,
                  "start_line": 12,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 146,
                "end": 174,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 179,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 179,
    "start_line": 1,
    "start_col": 0
  }
}
