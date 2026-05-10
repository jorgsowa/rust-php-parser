===source===
<?php class Foo {
    function clone() {}
    function match() {}
    function fn() {}
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
                  "name": "clone",
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
                "start": 22,
                "end": 41
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "match",
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
                "start": 46,
                "end": 65
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "fn",
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
                "start": 70,
                "end": 86
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
