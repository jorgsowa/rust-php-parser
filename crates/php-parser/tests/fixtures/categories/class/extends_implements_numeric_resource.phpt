===description===
`numeric`/`resource` are valid class/interface names, so they are also valid
targets in extends/implements clauses. Exercises the validate_class_ref path.
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
          "name": "numeric",
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
          "name": "resource",
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
          "name": "Foo",
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
