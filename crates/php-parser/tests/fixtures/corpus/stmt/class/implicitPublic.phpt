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
                "end": 36,
                "start_line": 4,
                "start_col": 4
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
                "end": 51,
                "start_line": 5,
                "start_col": 4
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
                "end": 84,
                "start_line": 6,
                "start_col": 4
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
                "end": 110,
                "start_line": 7,
                "start_col": 4
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
                "end": 137,
                "start_line": 8,
                "start_col": 4
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
                "end": 170,
                "start_line": 9,
                "start_col": 4
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
                "end": 186,
                "start_line": 10,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 187,
        "start_line": 3,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187,
    "start_line": 1,
    "start_col": 0
  }
}
