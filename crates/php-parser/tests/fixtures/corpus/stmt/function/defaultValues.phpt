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
          "name": {
            "name": "a",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": null,
              "default": {
                "kind": "Null",
                "span": {
                  "start": 28,
                  "end": 32
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
                "end": 32
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 38,
                  "end": 40
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "String": "foo"
                },
                "span": {
                  "start": 43,
                  "end": 48
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
                "end": 48
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 54,
                  "end": 56
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 59,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 60
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 62,
                        "end": 63
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 63
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
                "end": 63
              }
            },
            {
              "name": {
                "name": "f",
                "span": {
                  "start": 69,
                  "end": 71
                }
              },
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
                        "end": 76
                      }
                    }
                  }
                },
                "span": {
                  "start": 74,
                  "end": 76
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
                "end": 76
              }
            },
            {
              "name": {
                "name": "g",
                "span": {
                  "start": 82,
                  "end": 84
                }
              },
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
                        "end": 91
                      }
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 91
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
                "end": 91
              }
            },
            {
              "name": {
                "name": "h",
                "span": {
                  "start": 97,
                  "end": 99
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 102,
                  "end": 109
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
                "end": 109
              }
            },
            {
              "name": {
                "name": "i",
                "span": {
                  "start": 115,
                  "end": 117
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 120,
                  "end": 122
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
                "end": 122
              }
            },
            {
              "name": {
                "name": "j",
                "span": {
                  "start": 128,
                  "end": 130
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "String": "foo"
                          },
                          "span": {
                            "start": 134,
                            "end": 139
                          }
                        }
                      },
                      "span": {
                        "start": 134,
                        "end": 139
                      }
                    }
                  ]
                },
                "span": {
                  "start": 133,
                  "end": 140
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
                "end": 140
              }
            },
            {
              "name": {
                "name": "k",
                "span": {
                  "start": 146,
                  "end": 148
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "String": "foo"
                          },
                          "span": {
                            "start": 152,
                            "end": 157
                          }
                        }
                      },
                      "span": {
                        "start": 152,
                        "end": 157
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "bar"
                        },
                        "span": {
                          "start": 159,
                          "end": 164
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "String": "baz"
                          },
                          "span": {
                            "start": 168,
                            "end": 173
                          }
                        }
                      },
                      "span": {
                        "start": 159,
                        "end": 173
                      }
                    }
                  ]
                },
                "span": {
                  "start": 151,
                  "end": 174
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
                "end": 174
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
        "end": 179
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 179
  }
}
