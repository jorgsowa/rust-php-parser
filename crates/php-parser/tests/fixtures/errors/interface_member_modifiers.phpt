===source===
<?php
interface I {
    protected const A = 1;
    private const B = 1, C = 2;
    final protected const D = 1;
    protected function f();
    private static function g();
    final function h();
    abstract function i();
    function j() {}
    abstract public $a { get; }
    protected $b { get; }
    private $c { set; }
    final $d { get; }
}
===errors >=8.4===
Access type for interface constant I::A must be public
Access type for interface constant I::B must be public
Access type for interface constant I::D must be public
Access type for interface method I::f() must be public
Access type for interface method I::g() must be public
Interface method I::h() must not be final
Interface method I::i() must not be abstract
Interface function I::j() cannot contain body
Property in interface cannot be explicitly abstract. All interface members are implicitly abstract
Property in interface cannot be protected or private
Property in interface cannot be protected or private
Property in interface cannot be final
===php_error===
PHP Fatal error:  Access type for interface constant I::A must be public in Standard input code on line 3
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 46
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 65,
                      "end": 66
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 69,
                      "end": 70
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 78
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 72,
                      "end": 73
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 76,
                      "end": 77
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 78
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 105,
                      "end": 106
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 109,
                      "end": 110
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 83,
                "end": 111
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 135,
                      "end": 136
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 116,
                "end": 139
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 168,
                      "end": 169
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 144,
                "end": 172
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 192,
                      "end": 193
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 177,
                "end": 196
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 219,
                      "end": 220
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 201,
                "end": 223
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 237,
                      "end": 238
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 228,
                "end": 243
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 264,
                      "end": 266
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 269,
                        "end": 273
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 248,
                "end": 275
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 290,
                      "end": 292
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 295,
                        "end": 299
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 280,
                "end": 301
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 314,
                      "end": 316
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 319,
                        "end": 323
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 306,
                "end": 325
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 336,
                      "end": 338
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 341,
                        "end": 345
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 330,
                "end": 347
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 349
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 349
  }
}
