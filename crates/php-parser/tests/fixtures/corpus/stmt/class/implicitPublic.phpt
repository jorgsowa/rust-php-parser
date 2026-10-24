===source===
<?php

abstract class A {
    var $a;
    static $b;
    abstract function c();
    final function d() {}
    static function e() {}
    final static function f() {}
    function g() {}
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
              "start": 22,
              "end": 23
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "a",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 36
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 49,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 51
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 75,
                      "end": 76
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
                "start": 57,
                "end": 79
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 99,
                      "end": 100
                    }
                  },
                  "modifiers": {
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
                "start": 84,
                "end": 105
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 126,
                      "end": 127
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 110,
                "end": 132
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 159,
                      "end": 160
                    }
                  },
                  "modifiers": {
                    "is_static": true,
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
                "start": 137,
                "end": 165
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 179,
                      "end": 180
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
                "start": 170,
                "end": 185
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 187
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187
  }
}
