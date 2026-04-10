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
          "name": "A",
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
                  "name": "a",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                  "name": "b",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
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
                  "name": "c",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
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
                  "name": "d",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
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
                  "name": "e",
                  "visibility": null,
                  "is_static": true,
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
                "start": 110,
                "end": 132
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "f",
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": true,
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
                  "name": "g",
                  "visibility": null,
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
