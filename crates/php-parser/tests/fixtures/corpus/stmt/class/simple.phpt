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
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
            }
          },
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
              "end": 24
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
                "end": 37
              }
            },
            {
              "parts": [
                "D"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 39,
                "end": 40
              }
            }
          ],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "B"
                    },
                    "span": {
                      "start": 57,
                      "end": 60
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 70
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 62,
                      "end": 63
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "D"
                    },
                    "span": {
                      "start": 66,
                      "end": 69
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 70
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 83,
                      "end": 85
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 88,
                      "end": 91
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 76,
                "end": 91
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 93,
                      "end": 95
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "d"
                    },
                    "span": {
                      "start": 98,
                      "end": 101
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 76,
                "end": 101
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 117,
                      "end": 119
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 119
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 133,
                      "end": 135
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 135
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 158,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 142,
                "end": 164
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 192,
                      "end": 193
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 194,
                          "end": 196
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 194,
                        "end": 196
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
                "end": 200
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 227,
                      "end": 228
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
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
                          "end": 234
                        }
                      }
                    },
                    "span": {
                      "start": 233,
                      "end": 234
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 205,
                "end": 237
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 261,
                      "end": 262
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 242,
                "end": 267
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 289,
                      "end": 290
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
                "start": 272,
                "end": 295
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 297
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 297
  }
}
