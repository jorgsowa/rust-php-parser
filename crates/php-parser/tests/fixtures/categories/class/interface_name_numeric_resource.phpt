===description===
`numeric` and `resource` are valid interface names in PHP. The interface-name
reserved-word check must not reject them.
===source===
<?php
interface numeric {}
interface resource {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "numeric",
            "span": {
              "start": 16,
              "end": 23
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "resource",
            "span": {
              "start": 37,
              "end": 45
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
