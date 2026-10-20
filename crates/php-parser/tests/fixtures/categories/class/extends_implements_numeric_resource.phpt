===description===
`numeric` and `resource` are valid class/interface names, so PHP also accepts them in extends and implements clauses.
===source===
<?php
class numeric {}
interface resource {}
class Foo extends numeric implements resource {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "numeric",
            "span": {
              "start": 12,
              "end": 19
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "resource",
            "span": {
              "start": 33,
              "end": 41
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 23,
        "end": 44
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 51,
              "end": 54
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "numeric"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 63,
              "end": 70
            }
          },
          "implements": [
            {
              "parts": [
                "resource"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 82,
                "end": 90
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 45,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
